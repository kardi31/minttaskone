<?php
declare(strict_types=1);

namespace App\Service;

class TreeService
{
    /**
     * @param array $tree
     * @param array $list
     * @return array
     */
    public function appendNameToTree(array $tree, array $list): array
    {
        foreach ($tree as $key => $row) {
            $listRecordKey = array_search($row['id'], array_column($list, 'category_id'));
            if ($listRecordKey === false) {
                continue;
            }
            // might use locale to get current translation instead of hardcoding, but that was not in the scope of task
            $row['name'] = $list[$listRecordKey]['translations']['pl_PL']['name'];
            if (isset($row['children']) && is_array($row['children']) && !empty($row['children'])) {
                $row['children'] = $this->appendNameToTree($row['children'], $list);
            }
            $tree[$key] = $row;
        }

        return $tree;
    }
}
