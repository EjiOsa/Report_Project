<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Report extends Model
{
    // カラム名がcreated_atとかなら、不要な宣言。以下のように定数に設定すると自動化してくれる。
    // const CREATED_AT = 'create_date';
    // const UPDATED_AT = 'update_date';

    // リレーションシップ
    public function attachments() {
        return $this->hasMany('App\Attachment', 'parent_id', 'id')
            ->where('model', self::class);  // 「App\Report」のものだけ取得
    }

    // ソート機能
    use Sortable;
	public $sortable = ['title','user_name','created_at'];
}
