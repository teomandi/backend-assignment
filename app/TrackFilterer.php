<?php


namespace App;

use App\Models\Track;
use Illuminate\Http\Request;


class TrackFilterer
{
    private $query;
    private $mmsi;
    private $lon_range;
    private $lat_range;
    private $interval;  //in seconds

    public static function make(Request $request)
    {
        return new TrackFilterer($request);
    }

    private function __construct($request)
    {
        $this->query = Track::query();
        $this->mmsi = $request->input('mmsi');
        $this->lon_range = $request->input('lon_range');
        $this->lat_range = $request->input('lat_range');
        $this->interval = $request->input('interval');
    }

    public function apply()
    {
        if($this->mmsi){
            $this->query->whereIn('mmsi', $this->mmsi);
        }
        if($this->lon_range){
            sort($this->lon_range);
            $this->query->whereBetween('lon', $this->lon_range);
        }
        if($this->lat_range){
            sort($this->lat_range);
            $this->query->whereBetween('lat', $this->lat_range);
        }
        if($this->interval){
            sort($this->interval);
            $this->query->whereBetween('timestamp', $this->interval);
        }
        return $this;
    }

    public function get(){
        return $this->query->get();
    }
}