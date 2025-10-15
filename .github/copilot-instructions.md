## Quick orientation for AI coding agents

This is a Laravel 12 skeleton application (PHP 8.2) with Vite/Tailwind front-end assets. The goal of this file is to give an AI agent immediate, actionable knowledge so it can make safe, helpful code changes.

- Project root: `composer.json`, `package.json`, `artisan` and `vite.config.js`.
- Main app code: `app/` (controllers, models, providers). Views live in `resources/views` and web routes in `routes/web.php`.

## Big-picture architecture and intent

- MVC Laravel app. Requests hit routes in `routes/*.php` and are handled by controllers under `app/Http/Controllers`.
- Eloquent models are under `app/Models` (example: `User.php`). Use Eloquent conventions (fillable, casts, relationships) when adding or changing models.
- Front-end is built with Vite and Tailwind. Source JS and CSS live in `resources/js` and `resources/css` and are bundled via `npm run dev` / `npm run build`.

## Key developer workflows (commands you can run)

- Install & setup (common dev): run Composer then npm and initialize app keys and DB migrations from `composer.json` script `setup`.
  - Composer-level setup: run `composer install` and `php artisan key:generate` and `php artisan migrate` (the project's `composer.json` includes a `setup` array which runs these steps).
- Local dev server (multi-process): `composer run-script dev` or run the equivalent scripts manually:
  - `php artisan serve` to start the PHP server
  - `npm run dev` to start Vite
- Run tests: `composer test` (which runs `php artisan test`). Tests live in the `tests/` folder.

## Files and patterns to reference when editing code

- Routes: `routes/web.php` (HTTP routes), `routes/console.php` (console commands). Keep route definitions small; use controller classes for logic.
- Controllers: place request handling under `app/Http/Controllers`. The base `Controller` is minimal — use request validation with `Illuminate\Http\Request` and form requests when complex.
- Models: `app/Models/*` use Eloquent. Example `User.php` uses `HasFactory`, `Notifiable`, typed `fillable` and `hidden` arrays, and a `casts()` method. Mirror these conventions for new models.
- Factories and seeders: `database/factories/` and `database/seeders/` exist — prefer factories for test data.

## Project-specific conventions and gotchas

- PHP version: target PHP ^8.2 (see `composer.json`). Use typed properties and return types where appropriate.
- `casts()` in `User.php` is defined as a protected method returning an array instead of a simple property — follow this project's style when adding casts.
- Composer scripts already orchestrate common tasks (`setup`, `dev`, `test`). Update them only when you update CI or local workflow requirements.

## Integration points & external dependencies

- Laravel framework is the primary dependency. Look at `composer.json` for dev tools used (Pint, Pail, Sail, PHPUnit).
- Front-end: Vite + Tailwind (`package.json` + `vite.config.js`). Assets compiled by Vite are expected by default Blade views.

## Safe change rules for AI agents

- Keep changes minimal and localized. When adding routes, add tests under `tests/Feature` to show the behavior.
- Never change `composer.json` PHP requirement or framework version without an explicit user instruction.
- Use existing patterns: Eloquent models, controllers, factories, and migrations. If you add a migration, include a matching model/factory or seeder where relevant.

## Examples (copyable patterns)

- Register a simple GET route that uses a controller:

  routes/web.php:
  ```php
  Route::get('/rooms', [\App\Http\Controllers\RoomController::class, 'index']);
  ```

- Eloquent model skeleton (follow `User.php` style):

  app/Models/Room.php:
  ```php
  <?php
  namespace App\Models;

  use Illuminate\Database\Eloquent\Factories\HasFactory;
  use Illuminate\Database\Eloquent\Model;

  class Room extends Model
  {
      use HasFactory;

      protected $fillable = ['number', 'type', 'price'];
  }
  ```

## Where to look for more context

- `README.md` (project overview) and `composer.json` (scripts and dependencies).
- `app/Providers/AppServiceProvider.php` for global bootstrapping.

If anything here is unclear or you'd like additional examples (tests, CI config, migration examples), tell me which area to expand and I will iterate.
