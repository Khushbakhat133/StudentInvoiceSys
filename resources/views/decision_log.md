# ARCHITECTURAL DECISION LOG: STUDENT INVOICE SYSTEM

### 1. Database Paradigm: Single Table Inheritance (STI) vs. Separate Tables
For this application, we explicitly chose to use **Separate Tables** (`invoices` and `payments`) instead of **Single Table Inheritance (STI)**.

*   **Data Integrity & Normalization:** Invoices and Payments represent fundamentally distinct operational entities with different lifecycles and business columns. Forcing them into a single table via STI would introduce countless empty `NULL` spaces for mismatched rows, violating clean database normalization principles.
*   **Performance Optimization:** Utilizing separate tables allows us to maintain compact index paths directly on our foreign keys (`student_id` and `invoice_id`), keeping database search lookups rapid as row volume increases.
*   **Maintainability:** Keeping models specialized makes code maintenance cleaner and prevents unexpected code bleeding between billing lines and incoming receipts.

### 2. Eager Loading Strategy (N+1 Query Prevention)
To ensure optimal database performance, the application implements strict **Eloquent Eager Loading** instead of lazy loading.
*   **Trade-off Defense:** Rather than running separate database queries for every row loop (which causes the N+1 performance bottleneck), the system uses `Invoice::with(['student', 'payments'])`. This bundles related entities into single, highly optimized queries, verified cleanly with zero performance warnings via **Laravel Debugbar**.

### 3. Caching Strategy for Performance Optimization
To guarantee maximum scalability under peak student enrollment load, a caching system using **Laravel's Cache Facade** is proposed:

*   **Static List Storing:** Elements that rarely change (like course criteria in the `services` table) are cached indefinitely using `Cache::rememberForever()`.
*   **Dynamic Cache Invalidation:** Real-time metrics (like active student balance checks) are assigned a cache TTL threshold of 60 minutes. To prevent stale data anomalies, **Eloquent Model Observers** are attached. Whenever a student payment or invoice is registered, altered, or deleted, an event will automatically run `Cache::forget('student_billing_' . $studentId)` to keep the app database ledger synchronized.
