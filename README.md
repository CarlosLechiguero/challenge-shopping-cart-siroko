# Challenge Shopping Cart - Prueba Técnica

## Descripción
Diseño una cesta de compra (carrito) que permita a cualquier persona interesada comprar de forma rápida y eficiente y, a continuación, completar el proceso de pago generando una orden.

## Requisitos
- Docker y Docker Compose
- PHP 8.2
- Composer
- MySQL 8.0

## Instalación / Levantar el proyecto / Ejecución de test

1. Clonar el repositorio
`git clone <[repo].git>`

2. Levantar el proyecto
`docker-compose up -d`

3. Ejecución de test
`docker-compose exec php vendor/bin/phpunit`

## Presentación

El proyecto sigue una arquitectura limpia y orientada a dominio. Se utiliza Tactician como Command Bus para separar la lógica de aplicación de la infraestructura: cada acción del usuario se representa con un Command y se ejecuta mediante un Handler.

La entrada de usuario se maneja desde api/controller, mientras que la lógica del dominio y los servicios se encuentran en src. Esto mantiene la aplicación separada de Symfony, haciendo la lógica independiente del framework y fácil de probar.

Los servicios de dominio manejan las reglas de negocio sobre entidades como ShoppingCart y CartItem, usando Value Objects (QuantityValue, AmountValue) para garantizar la integridad de los datos.

La persistencia se realiza mediante repositorios, permitiendo testeo independiente de la infraestructura. Se ha utilizado la memoria Cache, para mantener los datos asociados al carrito de compra.

Los servicios y reglas de negocio cuentan con tests unitarios, ejecutables dentro del contenedor con PHPUnit.

## Datos adicionales

No seguí estrictamente lo de las feature branches y PRs, pero todos los cambios importantes están incluidos. Disculpad por no seguir el flujo estándar; soy consciente de cómo se gestiona normalmente el historial de commits.

Por otro lado, en el historial de commits cometí algunos errores que luego fui corrigiendo, dejando que el producto final se aproxime a los requerimientos de la prueba.
