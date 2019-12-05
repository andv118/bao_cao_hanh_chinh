<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DonViHanhChinh extends Model
{
    protected $table = "hc_coquanhanhchinh";
    protected $fillable = [
        'id',
        'code',
        'name',
        'parent_id',
        'position',
        'type',
        'role',
        'create_at',
        'update_at',
    ];
    public $timestamps = false;

    /**
     * Sắp xếp đệ quy đa cấp menu
     * @param array $list
     * @param int $parentId
     * @param string $prefix
     * @return array $result
     */
    public function getTreeData($list, $parentId, $prefix)
    {
        $result = [];
        $stt = 0;

        foreach ($list as $key => $item) {
            if ($item['parent_id'] == $parentId) {
                $stt++;
                if ($item['position'] == 0) {
                    $item['stt'] = $stt;
                } else {
                    $item['stt'] = $prefix . "." . $stt;
                }

                $result[] = $item;
                unset($list[$key]);
                $child = $this->getTreeData($list, $item['id'], $item['stt']);
                $result = array_merge($result, $child);
            }
        }
        return $result;
    }

}
