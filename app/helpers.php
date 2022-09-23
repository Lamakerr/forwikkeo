<?php

if(!function_exists("getJsonObject")) {

    function getJsonObject() {
    
      return json_decode(file_get_contents(storage_path() . "/json/table.json"));
    }
}
