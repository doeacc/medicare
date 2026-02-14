# Copilot / AI Agent Instructions for Medicare (PHP) repo

Purpose: provide concise, actionable guidance so an AI coding agent can be productive quickly in this procedural PHP project.

- Repo type: small monolithic PHP web app (no framework). Files live in the web root (examples: adminmainpage.php, customer-add.php, inventory-add.php).
- Run / debug: served by a local Apache+PHP stack (XAMPP). Open in a browser at `http://localhost/medicare/` after starting Apache & MySQL.

Key integration points
- Database: MySQL via `mysqli`. Connection is centralized in `config.php` (look there for `$conn`). Pages `include "config.php"` and use `$conn`.
- Forms: pages use HTML forms that POST back to the same PHP file (see `customer-add.php` using `action="<?= $_SERVER['PHP_SELF'] ?>"`).

Project conventions & patterns
- Coding style: procedural PHP with inline HTML. Keep this style for small changes; large refactors must be proposed separately.
- File naming: `<entity>-<action>.php` (examples: `inventory-add.php`, `customer-view.php`). Follow this for new CRUD pages.
- SQL usage: SQL is built as strings and executed with `mysqli_query()`. Current pages protect inputs with `mysqli_real_escape_string($conn, ...)`.
- UI: CSS files are in repo root (`form4.css`, `nav2.css`, etc.). Sidebar markup and dropdown JS are duplicated across pages — copy existing layout when adding pages.

Security & correctness (from existing code)
- Many queries are string-interpolated. Prefer prepared statements for security. If not migrating now, continue using `mysqli_real_escape_string()` consistently.
- Server-side validation is minimal. Add checks before SQL and echo status messages using the project's inline `<p>` style.

Concrete steps to add a new entity
1. Create: `<entity>-add.php`, `<entity>-view.php`, `<entity>-update.php` following `customer-add.php` and `inventory-add.php`.
2. `include "config.php"`, sanitize `$_POST` with `mysqli_real_escape_string($conn, ...)`, build SQL, call `mysqli_query($conn, $sql)`.
3. Reuse `.sidenav` markup for navigation and the existing CSS classes for layout.
4. Close DB connection with `$conn->close();` at end of script.

Developer / debugging tips
- No tests or build system: edit files and reload in browser. Enable PHP errors for development:

    ini_set('display_errors', 1);
    error_reporting(E_ALL);

- Use browser devtools or Postman for testing form POSTs.

Files to inspect (high value examples)
- `config.php` — DB connection and credentials.
- `customer-add.php` — form handling, escaping, and SQL INSERT pattern.
- `inventory-add.php`, `purchase-add.php`, `employee-add.php` — more CRUD examples.

Editing guidelines for AI contributions
- Preserve procedural style unless user asks for refactor.
- If changing SQL shape, include explicit column lists in `INSERT` statements.
- Keep UI messages and small HTML structure consistent with existing pages.

When to ask the user
- Request DB schema or credentials if `config.php` lacks them.
- Propose and get approval for cross-repo refactors (e.g., convert all DB interactions to prepared statements).

Next step: confirm whether to perform a targeted security upgrade (prepared statements) or add new features following current patterns.

If you'd like, I can also generate a checklist template for new entity pages (file header, required fields, example SQL). Reply to iterate.
