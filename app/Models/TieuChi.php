<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TieuChi extends Model
{
    protected $table = "bc_tieuchi";
    protected $fillable = [
        'id',
        'title',
        'unit',
        'description',
        'parent_id',
        'position',
        'danh_muc',
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

    /**
     * Kết hợp tiêu chí vào danh mục
     * @param array $listDanhMuc
     * @param array $listTieuChi
     * @return array $result
     */
    public function mergerTieuChi($listDanhMuc, $listTieuChi) {
        $result = array();

        foreach($listDanhMuc as $danhMuc) {
            $arrTieuChi = array();
            foreach($listTieuChi as $keyTC=>$tieuChi) {
                if($tieuChi['danh_muc'] == $danhMuc['id']) {
                    $arrTieuChi[] = $tieuChi;
                    unset($listTieuChi[$keyTC]);
                }
            }

            if(sizeOf($arrTieuChi) == 0) {
                $arrTieuChi = null;
            }
            $danhMuc['tieuchi'] = $arrTieuChi;
            $result[] = $danhMuc;
        }
        return $result;
    }

}
