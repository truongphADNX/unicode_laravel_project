<?php
//Boolean == false then singular noun - False khi danh từ số ít
function ConvertNoun($word,$bool = false) {
    $specalEndByOCharacter = ['piano', 'photo'];
    $specalWord = [
    "foot" => "feet",
    "tooth" => "teeth",
    "goose" => "geese",
    "ox" => "oxen",
    "fish" => "fish",
    "sheep" => "sheep",
    "mouse" => "mice",
    "woman" => "women",
    "man" => "men",
    "child" => "children",
    "person" => "people",
    "clothes" => "clothes",
    "police" => "police",
    "outskirts" => "outskirts",
    "cattle" => "cattle",
    "spectacles" => "spectacles",
    "glasses" => "glasses",
    "binoculars" => "binoculars",
    "scissors" => "scissors",
    "pliers" => "pliers",
    "shears" => "shears",
    "arms" => "arms",
    "goods" => "goods",
    "wares" => "wares",
    "damages" => "damages",
    "greens" => "greens",
    "earnings" => "earnings",
    "grounds" => "grounds",
    "particulars" => "particulars",
    "premises" => "premises",
    "quarters" => "quarters",
    "riches" => "riches",
    "savings" => "savings",
    "stairs" => "stairs",
    "surroundings" => "surroundings",
    "valuables" => "valuables",
    "spirits" => "spirits",
    "spirits" => "spirits",
    "acoustics" => "acoustics",
    "athletics" => "athletics",
    "ethics" => "ethics",
    "hysterics" => "hysterics",
    "mathematics" => "mathematics",
    "physics" => "physics",
    "linguistics" => "linguistics",
    "phonetics" => "phonetics",
    "logistics" => "logistics",
    "technics" => "technics",
    "politics" => "sppoliticsirits",
    "news" => "news",
    "mumps" => "mumps",
    "measles" => "measles",
    "rickets" => "rickets",
    "shingles" => "shingles",
    "billiards" => "billiards",
    "darts" => "darts",
    "draughts" => "draughts",
    "bowls" => "bowls",
    "dominoe" => "dominoe",
    "spirits" => "spirits",
    ];
    $word = strtolower($word);
    $word = trim($word);
    if($bool == true) {
        if (!array_key_exists($word,$specalWord )) {
            $suffix = "s";
            if (substr($word, -1) === "y") {
                $word = substr($word, 0, -1);
                $suffix = "ies";
            } elseif (substr($word, -1) === "f" ){
                $word = substr($word, 0, -1);
                $suffix = "ves";
            } elseif (substr($word, -2, 2) === "fe" ){
                $word = substr($word, 0, -2);
                $suffix = "ves";
            } elseif (substr($word, -2, 2) === "ch"
                || substr($word, -2, 2) === "sh"
                || substr($word, -2, 2) === "ss"
                || substr($word, -1) === "s"
                || substr($word, -1) === "x"
                || (substr($word, -1) === "o" && !in_array($word, $specalEndByOCharacter)) ){
                $suffix = "es";
            } elseif (substr($word, -1) === "z"){
                $suffix = "zes";
            }
            $word =  upperFirstKeyword($word);
            return $word.$suffix;
        }
        $word =  upperFirstKeyword($specalWord[$word]);
        return $word;
    }
    $word =  upperFirstKeyword($word);
    return $word;
}

function upperFirstKeyword($word){
    $word[0] = strtoupper($word[0]);
    return $word;
}
