<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $fillable = [
        'user_id',
        'status'
    ];
    // faz o relacionamento da table pedido com a table pedido_produto
    public function pedido_produtos()
    {
        return $this->hasMany('App\PedidoProduto')
            ->select( \DB::raw('produto_id, sum(desconto) as descontos, sum(valor) as valores, count(1) as qtd') )
            ->groupBy('produto_id')
            ->orderBy('produto_id', 'desc');
    }

    public function pedido_produtos_itens()
    {
        return $this->hasMany('App\PedidoProduto');
    }

    // faz uma consulta para verificar se existe um pepido reservado
    public static function consultaId($where)
    {
        $pedido = self::where($where)->first(['id']);
        // se o valor do pedido.id não for vazio retorna para a função
        return !empty($pedido->id) ? $pedido->id : null;
    }
}
