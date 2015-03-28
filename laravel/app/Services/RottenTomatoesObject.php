<?php
namespace App\Services;


class RottenTomatoesObject
{
    public $criticScore;
    public $audienceScore;
    public $image;
    public $runtime;
    public $abridgedCast;
    
    public function __construct($cScore, $aScore, $img, $rtime, $abrCast)
    {
        $this->criticScore = $cScore;
        $this->audienceScore = $aScore;
        $this->image = $img;
        $this->runtime = $rtime;
        foreach ($abrCast as $castMember)
        {
            $this->abridgedCast .= $castMember->name;
            $this->abridgedCast .= ' ';
        }
    }
}