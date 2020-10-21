<?php

namespace App\Services;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\Log;

/**
 * This class manage nested arrays in order to save recursive data into database.
 */
class NestedService
{

    /**
     * Parse a nested array into a flat array.
     * Each item should have a 'children' field which refer to a set of item with the same nature.
     * If the 'children' field has another name, the parameter $childrenField should be renamed.
     * Also, a field 'position' will be added for each item, which corresponds to the position of an item
     * within a 'children' array.
     * 
     */
    public static function flatten(
        array $nestedArray,
        string $idField = 'id',
        string $childrenField = 'children',
        string $positionField = 'position',
        string $parentField = 'parent_id',
        int $parentId = null
    ) {
        $flat = [];
        foreach ($nestedArray as $position => &$item) {
            // add fields to current item
            $item[$positionField] = $position; // position
            $item[$parentField] = $parentId; // parent_id

            // get flat children
            if (!array_key_exists($idField, $item))
                throw new Exception();

            $id = $item[$idField];
            $children = $item[$childrenField] ?? [];
                
            $flatChildren = self::flatten($children, $idField, $childrenField, $positionField, $parentField, $id);
            unset($item[$childrenField]); // remove 'children' field

            $flat = array_merge($flat, [$item], $flatChildren);
        }

        return $flat;
    }
}
