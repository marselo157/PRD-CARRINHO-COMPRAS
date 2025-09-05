# Simulador de Carrinho de Compras (PHP puro)

Projeto acadêmico para a disciplina **Design Patterns & Clean Code**.

## Objetivos
- Aplicar **PSR-12**, **KISS** e **DRY** em PHP puro.
- Simular um **carrinho de compras** com dados em **arrays**.
- Regras de negócio simples com **validações** e **cupom**.

## Estrutura
```
/src
  Cart.php
  ProductCatalog.php
  index.php
/docs
  RELATORIO.pdf
README.md
```

## Como executar (XAMPP)
1. Copie a pasta do projeto para `C:\xampp\htdocs\carrinho`
2. Inicie o Apache no XAMPP.
3. Acesse no navegador: `http://localhost/carrinho/src/index.php`.

> Requisito: PHP 8+.

## Dados fixos (arrays)
Os produtos são definidos em `src/index.php` conforme o PRD:
```php
$produtos = [
    ['id' => 1, 'nome' => 'Camiseta',    'preco' => 59.90,  'estoque' => 10],
    ['id' => 2, 'nome' => 'Calça Jeans', 'preco' => 129.90, 'estoque' => 5],
    ['id' => 3, 'nome' => 'Tênis',       'preco' => 199.90, 'estoque' => 3],
];
```

## Funcionalidades
- **Adicionar** item ao carrinho (valida produto e estoque, reduz estoque).
- **Remover** item do carrinho (restaura estoque).
- **Listar** itens com `id_produto`, `quantidade`, `subtotal`.
- **Totalizar** carrinho.
- **Cupom**: `DESCONTO10` aplica **10%**.

## Casos de uso demonstrados em `index.php`
1. Adição válida (id=1, qtd=2).
2. Tentativa de adicionar além do estoque (id=3, qtd=10) → erro.
3. Remoção de item (id=1) com restauração de estoque.
4. Aplicação do cupom `DESCONTO10` com cálculo de desconto e total final.

## Limitações
- Sem banco de dados.
- Sem autenticação.
- Sem formulários (simulação por variáveis).
- Apenas PHP puro (sem frameworks).

## Boas práticas adotadas
- **PSR-12**: `declare(strict_types=1)`, nomes descritivos, classes e métodos com tipagem, 4 espaços de indentação.
- **KISS**: classes curtas, regras simples, poucos métodos públicos.
- **DRY**: cálculos centralizados, validações reutilizáveis, nada duplicado.
- **Organização**: separação por responsabilidade (`Cart` e `ProductCatalog`).

## Autores
- Nome: Marcelo Beverari do Nascimento Filho
- RA: 1997165

# Simulador de Carrinho de Compras (PHP puro)

Projeto acadêmico para a disciplina **Design Patterns & Clean Code**.

## Objetivos
- Aplicar **PSR-12**, **KISS** e **DRY** em PHP puro.
- Simular um **carrinho de compras** com dados em **arrays**.
- Regras de negócio simples com **validações** e **cupom**.

## Estrutura
```
/src
  Cart.php
  ProductCatalog.php
  index.php
/docs
  RELATORIO.pdf
README.md
```

## Como executar (XAMPP)
1. Copie a pasta do projeto para `C:\xampp\htdocs\carrinho`
2. Inicie o Apache no XAMPP.
3. Acesse no navegador: `http://localhost/carrinho/src/index.php`.

> Requisito: PHP 8+.

## Dados fixos (arrays)
Os produtos são definidos em `src/index.php` conforme o PRD:
```php
$produtos = [
    ['id' => 1, 'nome' => 'Camiseta',    'preco' => 59.90,  'estoque' => 10],
    ['id' => 2, 'nome' => 'Calça Jeans', 'preco' => 129.90, 'estoque' => 5],
    ['id' => 3, 'nome' => 'Tênis',       'preco' => 199.90, 'estoque' => 3],
];
```

## Funcionalidades
- **Adicionar** item ao carrinho (valida produto e estoque, reduz estoque).
- **Remover** item do carrinho (restaura estoque).
- **Listar** itens com `id_produto`, `quantidade`, `subtotal`.
- **Totalizar** carrinho.
- **Cupom**: `DESCONTO10` aplica **10%**.

## Casos de uso demonstrados em `index.php`
1. Adição válida (id=1, qtd=2).
2. Tentativa de adicionar além do estoque (id=3, qtd=10) → erro.
3. Remoção de item (id=1) com restauração de estoque.
4. Aplicação do cupom `DESCONTO10` com cálculo de desconto e total final.

## Limitações
- Sem banco de dados.
- Sem autenticação.
- Sem formulários (simulação por variáveis).
- Apenas PHP puro (sem frameworks).

## Boas práticas adotadas
- **PSR-12**: `declare(strict_types=1)`, nomes descritivos, classes e métodos com tipagem, 4 espaços de indentação.
- **KISS**: classes curtas, regras simples, poucos métodos públicos.
- **DRY**: cálculos centralizados, validações reutilizáveis, nada duplicado.
- **Organização**: separação por responsabilidade (`Cart` e `ProductCatalog`).

## Autores
- Nome: Marcelo Beverari do Nascimento Filho
- RA: 1997165

