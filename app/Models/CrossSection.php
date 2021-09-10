<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Log;
use phpDocumentor\Reflection\File;
use phpDocumentor\Reflection\Types\Resource_;

class CrossSection extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'profile_id',
        'name',
        'position',
        'v_scale',
        'h_scale',
        'bank_l',
        'bank_r',
        'reference_level',
        'font_size',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function profile():belongsTo
    {
        return $this->belongsTo(Profile::class);
    }

    public function points():hasMany
    {
        return $this->hasMany(Point::class)->orderBy('x','asc');
    }

    /**
     * Method analyses cross-section points and returns the shortest
     * horizontal distance (offset) between any points
    */
    public function minPointsDiff():float
    {
        $points = $this->points->toArray();
        $offset = $points[1]['x'] - $points[0]['x'] ;
        foreach($points as $key => $point){
            if($key>1){
                if(($point['x']-$points[$key-1]['x'])<$offset){
                    $offset = $point['x']-$points[$key-1]['x'] ;
                }
            }
        }
        return $offset;
    }

    /**
     * Method analyses points structure, compares it with scale and
     * calculates the best font size for picture
    */
    public function fitFont():float
    {
        return ($this->minPointsDiff()/$this->h_scale)/2;
    }

    public function drawCad(float $start_x=0, float $start_y=0):string
    {
        try {
            $this->font_size = $this->fitFont();
            $fileName = "storage/cross_sections/scripts/" . $this->name . "_" . $this->id . "_cs.scr";
            $dwgScript = fopen($fileName, "w") or die("Unable to open file!");

            $left_offset    = 30*$this->font_size;
            $font_offset    = 0.2*$this->font_size;
            $h_offset       = 5*$this->font_size;
            $reference_lvl = $this->reference_level;



            //initial line
            $txt = "_snap\n_off\n_grid\n_off\n_ortho\n_off\n_osmode\n0";
            fwrite($dwgScript, $txt);
            // reference lvl line and text:
            $txt = "\n";
            $txt.= "_text\n";
            $txt.= -1*$left_offset.",".$font_offset."\n";
            $txt.= $this->font_size."\n";
            $txt.= "0.00\n";
            $txt.= __('cross-country.cross-section.drawing.ref_lvl').": ".sprintf("%0.2f",$reference_lvl)." m "
                .__('cross-country.cross-section.drawing.asl')."\n";

            // offset text
            $txt.= "_text\n";
            $txt.= (-1*$left_offset+$font_offset).",".(-1*$h_offset+$font_offset)."\n";
            $txt.= $this->font_size."\n";
            $txt.= "0.00\n";
            $txt.= strtoupper(__('cross-country.cross-section.drawing.elevation'))."\n";

            // elevation text
            $txt.= "_text\n";
            $txt.= (-1*$left_offset+$font_offset).",".(-2*$h_offset+$font_offset)."\n";
            $txt.= $this->font_size."\n";
            $txt.= "0.00\n";
            $txt.= strtoupper(__('cross-country.cross-section.drawing.offset'))."\n";
            fwrite($dwgScript, $txt);

            $points = $this->points->toArray();

            // writing cross section name against first point height

            // Cs name:
            $txt= "_text\n";
            $txt.= (-1*$left_offset+$font_offset).",".($points[0]['y']-$reference_lvl)/$this->v_scale."\n";
            $txt.= $this->font_size."\n";
            $txt.= "0.00\n";
            $txt.= __('cross-country.cross-section.drawing.cs_name')."\n";
            $txt.= "_text\n";
            $txt.= (-1*$left_offset+$font_offset).",".((($points[0]['y']-$reference_lvl)/$this->v_scale)-2*$this->font_size)."\n";
            $txt.= $this->font_size."\n";
            $txt.= "0.00\n";
            $txt.= $this->name."\n";
            fwrite($dwgScript, $txt);

            foreach($points as $key => $point) {
                //vertical line
                $txt = "_line\n"
                    .($start_x+$point['x'])/$this->h_scale.",".($start_y/$this->v_scale)."\n";
                $txt .= ($start_x + $point['x'])/$this->h_scale . "," . ($start_y + $point['y']-$reference_lvl)/$this->v_scale."\n";

                if($key>0){
                    //if point is not "first-one" then vertical line continues to top of previous line
                    $txt.=($start_x+$points[$key-1]['x'])/$this->h_scale.",".($start_y+$points[$key-1]['y']-$reference_lvl)/$this->v_scale."\n";
                }
                $txt.="\n"; // just tapping enter to finish line

                // frame side of vertical lines
                $txt.="_line\n"
                    .($start_x+$point['x'])/$this->h_scale.",".$start_y."\n";
                $txt.=($start_x+$point['x'])/$this->h_scale.",".($start_y-2*$h_offset)."\n\n";

                //filling points text
                //a) elevation
                $txt.="_text\n";
                $txt.=($start_x+$point['x']-$font_offset)/$this->h_scale.",".($start_y-1*$h_offset+$font_offset)."\n";
                $txt.=$this->font_size."\n";
                $txt.="90\n"; // text rotation
                $txt.=sprintf("%0.2f",$point['y'])."\n";


                //b) offset
                $txt.="_text\n";
                $txt.=($start_x+$point['x']-$font_offset)/$this->h_scale.",".($start_y-2*$h_offset+$font_offset)."\n";
                $txt.=$this->font_size."\n";
                $txt.="90\n"; // text rotation
                $txt.=sprintf("%0.2f",$point['x'])."\n";

                fwrite($dwgScript, $txt);
            }


            // Reference level line:
            $txt= "_line\n"
                .$points[sizeof($points)-1]['x']/$this->h_scale.",".$start_y."\n";
            $txt.= ($start_x-$left_offset).",".$start_y."\n\n";

            // Offset level line:
            $txt.= "_line\n"
                .$points[sizeof($points)-1]['x']/$this->h_scale.",".($start_y-$h_offset)."\n";
            $txt.= ($start_x-$left_offset).",".($start_y-$h_offset)."\n\n";

            // Height level line:
            $txt.= "_line\n"
                .$points[sizeof($points)-1]['x']/$this->h_scale.",".($start_y-2*$h_offset)."\n";
            $txt.= ($start_x-$left_offset).",".($start_y-2*$h_offset)."\n";
            //...and just closing line:
            $txt.= ($start_x-$left_offset).",".($start_y)."\n\n";

            fwrite($dwgScript, $txt);

            // zooming to whole drawing
            $txt="_zoom\n_e\n";
            fwrite($dwgScript, $txt);

            fclose($dwgScript);

            return asset($fileName);
        } catch (\Exception $e){
            error_log("============================================================");
            error_log("Error: ".$e->getMessage());
            Log::error("An error occurred while drawing cross section: ".$this->name."\n".$e->getMessage());
            return "An error occurred while drawing cross section: ".$this->name;
        }
    }
}
