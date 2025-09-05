<?php
declare(strict_types=1);

namespace App;

final class Cart
{
    /** @var array<int, int> chave = id_produto, valor = quantidade */
    private array $items = [];

    public function add(ProductCatalog $catalog, int $productId, int $qty): void
    {
        if ($qty <= 0) {
            throw new \InvalidArgumentException('Quantidade deve ser positiva.');
        }
        if (!$catalog->exists($productId)) {
            throw new \RuntimeException('Produto não encontrado.');
        }

        // Verifica estoque com base no total que ficará no carrinho
        $current = $this->items[$productId] ?? 0;
        $needed = $qty;
        $catalog->reduceStock($productId, $needed);
        $this->items[$productId] = $current + $qty;
    }

    public function remove(ProductCatalog $catalog, int $productId): void
    {
        if (!isset($this->items[$productId])) {
            throw new \RuntimeException('Item não está no carrinho.');
        }
        $qty = $this->items[$productId];
        unset($this->items[$productId]);
        $catalog->restoreStock($productId, $qty);
    }

    /** @return array<int, array{id_produto:int, quantidade:int, subtotal:float}> */
    public function listItems(ProductCatalog $catalog): array
    {
        $list = [];
        foreach ($this->items as $id => $qty) {
            $product = $catalog->get($id);
            if ($product === null) {
                // Resiliência simples: ignora item órfão
                continue;
            }
            $subtotal = round($product['preco'] * $qty, 2);
            $list[] = [
                'id_produto' => $id,
                'quantidade' => $qty,
                'subtotal'   => $subtotal,
            ];
        }
        return $list;
    }

    public function total(ProductCatalog $catalog): float
    {
        $sum = 0.0;
        foreach ($this->items as $id => $qty) {
            $product = $catalog->get($id);
            if ($product === null) {
                continue;
            }
            $sum += $product['preco'] * $qty;
        }
        return round($sum, 2);
    }

    /**
     * Aplica cupom simples DESCONTO10 (10%).
     * @return array{cupom:string|null, desconto:float, total_final:float}
     */
    public function totalWithCoupon(ProductCatalog $catalog, ?string $couponCode): array
    {
        $total = $this->total($catalog);
        $couponCode = $couponCode !== null ? trim(strtoupper($couponCode)) : null;

        if ($couponCode === 'DESCONTO10') {
            $discount = round($total * 0.10, 2);
            $final = round($total - $discount, 2);
            return ['cupom' => $couponCode, 'desconto' => $discount, 'total_final' => $final];
        }

        return ['cupom' => null, 'desconto' => 0.0, 'total_final' => $total];
    }
}
