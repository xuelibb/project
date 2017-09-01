<?php  
namespace App\Model\Admin;  
use Illuminate\Database\Eloquent\Model;  
use Illuminate\Support\Facades\DB; 
class Lottery extends Model  
{  
    protected $table = 'activity';  
    public $timestamps = false;
    public function read()//查
    {  
        return $this->get()->toArray();
    }  
    public function one($data,$arr)//单条查询  
    {  
        return $this->where($data,$arr)->get()->toArray();  
    }  
    public function del($data)//删  
    {  
        $country = $this->where($data);  
        return $country->delete();
    }  
    public function upd($data,$list,$arr)//改  
    {  
        $country = $this->where($data,$list);  
        return $country->update($arr);  
    }  
    public function add($data)//增  
    {  
        return DB::table('activity')->insert($data);  
    }  
}  