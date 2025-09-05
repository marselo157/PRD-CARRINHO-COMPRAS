<?php
declare(strict_types=1);

namespace App;

final class ProductCatalog
{
    /** @var array<int, array{id:int, nome:string, preco:float, estoque:int}> */
    private array $products;

    /**
     * @param array<int, array{id:int, nome:string, preco:float, estoque:int}> $products
     */
    public function __construct(array $products)
    {
        $this->products = [];
        foreach ($products as $p) {
            $this->products[$p['id']] = $p;
        }
    }

    public function exists(int $id): bool
    {
        return array_key_exists($id, $this->products);
    }

    /** @return array{id:int, nome:string, preco:float, estoque:int}|null */
    public function get(int $id): ?array
    {
        return $this->products[$id] ?? null;
    }

    public function reduceStock(int $id, int $qty): void
    {
        if ($qty <= 0) {
            throw new \InvalidArgumentException('Quantidade deve ser positiva.');
        }
        if (!$this->exists($id)) {
            throw new \RuntimeException('Produto não encontrado.');
        }
        if ($this->products[$id]['estoque'] < $qty) {
            throw new \RuntimeException('Estoque insuficiente.');
        }
        $this->products[$id]['estoque'] -= $qty;
    }

    public function restoreStock(int $id, int $qty): void
    {
        if ($qty <= 0) {
            throw new \InvalidArgumentException('Quantidade deve ser positiva.');
        }
        if (!$this->exists($id)) {
            throw new \RuntimeException('Produto não encontrado.');
        }
        $this->products[$id]['estoque'] += $qty;
    }

    /** @return array<int, array{id:int, nome:string, preco:float, estoque:int}> */
    public function all(): array
    {
        return array_values($this->products);
    }
}
