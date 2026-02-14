# Medical Store Management (medicare)

Small procedural PHP web app for managing a medical store (inventory, purchases, suppliers, employees, POS, reports).

Quick start (Windows, XAMPP):

1. Start XAMPP and enable `Apache` + `MySQL`.
2. Put this project under XAMPP `htdocs` (already located at `C:\xampp\htdocs\medicare`).
3. Verify DB credentials in `config.php` and ensure the database exists.
4. Open the app in a browser, e.g. `http://localhost/medicare/customer-add.php`.

Developer notes:
- UI modernized to Bootstrap 5 in many pages; legacy CSS files were retained where needed but removed from standard views.
- Server-side uses procedural `mysqli` via `config.php`.
- Next recommended steps:
  - Browser QA and resolve Bootstrap/legacy CSS conflicts.
  - Consolidate navigation/header into a shared `header.php` include.
  - Migrate DB queries to prepared statements to improve security.

If you want, I can create a GitHub repo and push this project — provide the remote URL or authorize and I will push.
