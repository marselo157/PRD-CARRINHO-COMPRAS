<?php
declare(strict_types=1);

use App\ProductCatalog;
use App\Cart;

require __DIR__ . '/ProductCatalog.php';
require __DIR__ . '/Cart.php';

$produtos = [
    ['id' => 1, 'nome' => 'Camiseta',    'preco' => 59.90,  'estoque' => 10],
    ['id' => 2, 'nome' => 'Calça Jeans', 'preco' => 129.90, 'estoque' => 5],
    ['id' => 3, 'nome' => 'Tênis',       'preco' => 199.90, 'estoque' => 3],
];

$catalogo = new ProductCatalog($produtos);
$carrinho = new Cart();

function printSection(string $title): void {
    echo "\n<hr><h2>{$title}</h2>\n";
}

function printState(ProductCatalog $cat, Cart $cart, ?string $cupom = null): void {
    echo "<h3>Itens no Carrinho</h3>";
    echo "<pre>";
    foreach ($cart->listItems($cat) as $item) {
        echo json_encode($item, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) . "\n";
    }
    echo "</pre>";

    $total = $cart->total($cat);
    $cupomInfo = $cart->totalWithCoupon($cat, $cupom);
    echo "<p><strong>Total:</strong> R$ " . number_format($total, 2, ',', '.') . "</p>";
    if ($cupomInfo['cupom'] !== null) {
        echo "<p><strong>Cupom:</strong> {$cupomInfo['cupom']} | <strong>Desconto:</strong> R$ " . number_format($cupomInfo['desconto'], 2, ',', '.') . "</p>";
    }
    echo "<p><strong>Total Final:</strong> R$ " . number_format($cupomInfo['total_final'], 2, ',', '.') . "</p>";

    echo "<h3>Estoque Atual</h3><pre>";
    foreach ($cat->all() as $p) {
        echo json_encode($p, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) . "\n";
    }
    echo "</pre>";
}

// ===== Caso 1 — Usuário adiciona um produto válido =====
printSection('Caso 1 — Adicionar produto válido (id=1, qtd=2)');
try {
    $carrinho->add($catalogo, 1, 2);
    echo '<p>Produto adicionado com sucesso.</p>';
} catch (Throwable $e) {
    echo '<p style="color:red">Erro: ' . htmlspecialchars($e->getMessage()) . '</p>';
}
printState($catalogo, $carrinho);

// ===== Caso 2 — Tenta adicionar além do estoque =====
printSection('Caso 2 — Tentar adicionar além do estoque (id=3, qtd=10)');
try {
    $carrinho->add($catalogo, 3, 10);
    echo '<p>Produto adicionado com sucesso.</p>';
} catch (Throwable $e) {
    echo '<p style="color:red">Erro: ' . htmlspecialchars($e->getMessage()) . '</p>';
}
printState($catalogo, $carrinho);

// ===== Caso 3 — Usuário remove produto do carrinho =====
printSection('Caso 3 — Remover produto (id=1)');
try {
    $carrinho->remove($catalogo, 1);
    echo '<p>Produto removido e estoque restaurado.</p>';
} catch (Throwable $e) {
    echo '<p style="color:red">Erro: ' . htmlspecialchars($e->getMessage()) . '</p>';
}
printState($catalogo, $carrinho);

// ===== Caso 4 — Aplicação de cupom de desconto =====
printSection('Caso 4 — Aplicar cupom DESCONTO10');
try {
    // Adiciona algo de novo para testar o cupom
    $carrinho->add($catalogo, 2, 1); // 1 Calça Jeans
    $carrinho->add($catalogo, 3, 1); // 1 Tênis
    echo '<p>Itens adicionados para demonstração do cupom.</p>';
} catch (Throwable $e) {
    echo '<p style="color:red">Erro: ' . htmlspecialchars($e->getMessage()) . '</p>';
}
printState($catalogo, $carrinho, 'DESCONTO10');

echo "\n<hr><p><em>Simulador de Carrinho de Compras — PHP puro, PSR-12, KISS/DRY</em></p>\n";
