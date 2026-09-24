# CMCP Orchestration Journal

## Task engine-20260911142256-merchandising-4f8e61

### Iteration 1 — reconnaissance and baseline

- Target: `Merchandising`, workspace `D:\PhpstormProjects\www\Merchandising`.
- Responsibility: compose storefront merchandising surfaces from source-backed items without owning product, category, vendor, payment, shipping, or user truth.
- Read target `README.md`, `AGENTS.md`, `composer.json`, representative controller, entities, repository, services, source contracts, and architecture/unit tests.
- Read mandatory dependency contour documentation/manifests for Objecting, Cruding, Viewing, and Interfacing.
- Read Canonization normative rules Canon000, Canon018, Canon019, and Canon038.
- Read Gating README/AGENTS/composer contract as executable companion.

### Baseline findings

- `composer.json` package identity is `merchandising/merch`; Canon018 maps the PHP subject prefix to `Merch*` and namespace root to `App\\Merchandising\\`.
- Current source predominantly uses `Merchandising*` types, creating Canon000/Canon018 naming drift requiring a bounded rename wave.
- Mandatory dependencies `objecting/object`, `cruding/crud`, `viewing/view`, and `interfacing/interface` are absent from target `require`.
- No generic CRUD controller was found in the inspected controller surface.
- Doctrine tables inspected use the documented `merch_` prefix.
- Current entities locally own generic-looking title/status/source metadata; Objecting adoption requires semantic classification before migration.
- Guarded Git status reports this workspace is not currently a Git repository.

### Selected RC-critical workstream

1. Restore the mandatory Composer dependency contour and local path wiring.
2. Add regression coverage for Composer identity/dependency declarations.
3. Run package quality checks and inspect failures.
4. Keep full `Merchandising*` to canonical `Merch*` migration as required RC debt unless authoritative vocabulary changes.

### Growth workstream (post-RC)

- Merchant rules/pinning and ranking policy.
- Experimentation/A-B allocation and exposure diagnostics.
- Analytics around candidate selection and placement effectiveness.
- Personalization inputs through typed source contracts without importing neighboring persistence ownership.

### Gates

- Composer validation/resolution; PHP syntax; PHPUnit; PHPStan; CS dry run; Canonization/Gating where consumable.

### Iteration 2 — material implementation

- Added mandatory runtime dependencies `cruding/crud`, `interfacing/interface`, `objecting/object`, and `viewing/view`.
- Added local Composer path repositories with symlink/junction wiring to the four sibling repositories.
- Updated `composer.lock`; required sibling packages now resolve locally and the Symfony dependency set was aligned from stale 8.0 lock entries to the declared Symfony 8.1 constraints.
- Added `phpstan/phpstan-doctrine` as a development dependency.

### Iteration 3 — verification and fix

- Removed obsolete PHPStan `checkMissingIterableValueType` configuration and enabled PHPStan Doctrine extension/rules.
- Repaired the invalid PHP-CS-Fixer Finder call and aligned risky-fixer configuration with the configured `declare_strict_types` rule.
- Removed an unused DependencyInjection import and normalized formatter-reported tails.
- Added `quality:cs:fix` as the repair counterpart to the existing CS dry-run gate.
- Added architecture regression coverage for canonical package identity, namespace mapping, and all four mandatory helper dependencies.

### Iteration 4 — debt closure and integration

- `composer quality` is green: PHPStan reports no errors; PHPUnit passes 5 tests / 18 assertions; PHP-CS-Fixer reports 0 of 39 files needing fixes.
- `composer validate` passes. `composer validate --strict` reports warning status only for the explicit `version` field and local `*@dev` sibling constraints; there are no lock mismatch errors after dependency update.
- Helper manifests were inspected where present: Objecting, Cruding, and Viewing. Interfacing has no root `MANIFEST.json` in the current tree.
- Git integration cannot be performed: guarded `git status` confirms the target directory is not a Git repository.

### Iteration 5 — final acceptance and handoff

- Acceptance is not RC-green because Canon018 remains violated: package `merchandising/merch` normatively maps component-owned PHP subject types to `Merch*`, while the current source still contains numerous `Merchandising*` class names.
- The full subject-prefix migration is a repository-wide rename/caller update and was not partially or mechanically applied in this run; leaving a mixed `Merch*` / `Merchandising*` model would be less canonical than the current single model.
- Objecting adoption for local `title`, `status`, and source-like fields remains semantic work: no field was mechanically replaced without establishing system-field equivalence.
- No generic CRUD controller drift was introduced; the business surface payload endpoint remains within Merchandising responsibility.
- No files were deleted.

### Final state

- Green: Composer lock resolution, PHPStan, PHPUnit, PHP-CS-Fixer dry run, normal Composer validation.
- Blocking RC debt: Canon018/Canon000 `Merchandising*` -> `Merch*` subject-prefix migration across source/tests/config references.
- Integration blocker: no `.git` repository metadata at the target workspace, so stage/commit/push/PR cannot be executed truthfully.

## RC continuation — 2026-09-13/14

### Reconnaissance and canon mapping

- Re-read the current target architecture, source, tests, package/runtime configuration, and prior journal before continuing implementation.
- Read the normative Canonization rule texts and guard matrix relevant to this component, including Canon000-040 with focused re-checks of Canon002, Canon020, and Canon030.
- Read mandatory dependency contracts: Objecting `AGENTS.md`, `README.md`, `composer.json`, `MANIFEST.json`; Cruding `AGENTS.md`, `README.md`, `composer.json`, `MANIFEST.json`; Viewing `AGENTS.md`, `README.md`, `composer.json`, `MANIFEST.json`; Interfacing `AGENTS.md`, `README.md`, `composer.json`. Interfacing has no root `MANIFEST.json` in the current tree.
- Read Gating as the executable enforcement companion and materialized an explicit Merchandising profile instead of relying on profile-less skips.
- Target-to-canon mapping: `merchandising/merch` maps to namespace `App\\Merchandising\\`, subject prefix `Merch*`, config/database prefix `merch_`, Symfony technical-role-first roots, Cruding-owned generic CRUD, Objecting-owned reusable system packs, standalone+bundle runtime, packaged production Composer dependencies, PostgreSQL `data` plus SQLite `infra`, PHP quality tooling, PHPUnit coverage, and Doctrine schema-parity tooling.
- Canon008/009/012 remain profile-conditional skips because the target profile declares no namespace-package map, host namespace allowlist, or internal typed-boundary roots. Dependency integrity, host isolation, and typed source contracts were instead verified directly from Composer/source topology; no artificial profile vocabulary was invented solely to eliminate skips.

### Material implementation

- Initialized Git in the previously metadata-free workspace to make repository integration possible.
- Completed the canonical `Merchandising*` -> `Merch*` subject migration while preserving the `App\\Merchandising\\` namespace root.
- Moved types into explicit role roots: `DTO`, `Enum`, `ValueObject`, `Provider`, and mirrored `ProviderInterface`; retained `Service`/`ServiceInterface` only for actual service responsibilities.
- Renamed component-owned route configuration to `config/routes/merch_surface.yaml`.
- Removed demo candidate implementations from production autoload; legacy demo files were preserved under ignored `var/` for non-destructive audit history.
- Replaced demo-bound production surface wiring with source-contract composition and fail-fast unsupported-surface handling.
- Added the complete standalone platform dependency baseline and local symlink path repositories for development dependencies, including Collectioning, Tabling, Cruding, Interfacing, Objecting, and Viewing.
- Added `composer.prod.json`, standalone `Kernel`, bundle registration, `bin/console`, framework configuration, deterministic Doctrine configuration, and runtime smoke script.
- Added explicit `data` PostgreSQL and `infra` SQLite Doctrine roles and `underscore_number_aware` ORM naming.
- Added Doctrine Migrations tooling, component-owned migration configuration, `merch_migration_versions`, initial PostgreSQL migration for `merch_surface`, `merch_section`, and `merch_placement`, plus schema/migration verification scripts.
- Added a Merchandising-specific executable Gating profile with `Merch` subject vocabulary and Canon000-040 enforcement appropriate to this renderer-neutral backend component.
- Completed `.gitignore` coverage for generated state, local environment, IDE state, and OS noise.
- Added targeted unit coverage for value-object serialization, candidate filtering/sorting/limits, direct-neighbor topology, entity behavior, controller request mapping, and unsupported-surface failure.
- Added meaningful source PHPDoc; current Canon031 coverage is 31/31 classes (100%) and 53/62 methods (85.5%).
- One-off migration/PHPDoc helpers were moved into ignored `var/` after use and are not product tooling.

### Verification and fixes

- `composer quality`: green — PHPStan 0 errors, PHPUnit 12 tests / 58 assertions, PHP-CS-Fixer dry-run 0 changes.
- `composer quality:phpunit:coverage`: green — lines 90.6%, methods 90.7%, branches 100.0%; persistent summary written to ignored `var/coverage/summary.txt`.
- `composer canon:check`: green — 41 rules, 0 failed, 0 warning, 3 justified profile-conditional skips (Canon008/009/012).
- `composer runtime:about`: previously verified standalone Symfony 8.1.6 / PHP 8.4.13 boot with `App\\Merchandising\\Kernel`; final re-check still required after the latest documentation-only changes.
- `composer quality:doctrine:schema`: green — Doctrine mapping files are correct; database synchronization intentionally skipped by this mapping-only command.
- `composer quality:doctrine:migrations`: executable but externally blocked because the reachable local PostgreSQL server requires credentials for user `app`; no secret was invented or committed and the canonical PostgreSQL role was not replaced with SQLite to manufacture a false green.
- Composer dependency resolution completed successfully and reported no security vulnerability advisories.

### RC-critical versus growth

- RC-critical: canonical subject/tree identity, source-contract boundary, production placeholder removal, dependency/runtime packaging, executable Gating, schema-parity tooling, quality/coverage, diagnostics, and truthful database-verification blocker handling.
- Growth (non-blocking): merchant rules/pinning, ranking/boost policy, segmentation, experimentation/A-B allocation, analytics, personalization inputs, and agentic merchandising improvements.

### Remaining acceptance tail

- Re-run final quality, coverage, canon, runtime, Composer validation, syntax and Doctrine mapping checks after journal/helper cleanup.
- Inspect Git worktree/HEAD/remote/upstream; create a coherent signed commit when permitted, publish only if a real remote exists, then re-run post-integration acceptance.
- Full PostgreSQL migration-currentness remains dependent on valid local database credentials or an isolated disposable PostgreSQL environment; do not mark that specific runtime check green without factual execution.

### Iteration 4 — debt closure and integration

- Final pre-integration gates were green: normal Composer validation, PHPStan, PHPUnit 12 tests / 58 assertions, CS dry-run, standalone Symfony boot, Doctrine mapping validation, PHP syntax, Canon031 PHPDoc coverage 100% classes / 85.5% methods, and Canon040 coverage 90.6% lines / 90.7% methods / 100% branches.
- Strict Composer validation reports warnings only for the explicit root version and canonical local `*@dev` sibling constraints; there are no lock/schema errors.
- Generated `.codebase-memory/` is ignored rather than committed; its pre-existing artifact had no commit identity and is runtime-derived.
- Created signed root commit `570471d` (`feat: harden Merchandising for RC`).
- Post-commit inspection found embedded Gating IDE state and historical command logs accidentally included with the pre-existing policy copy. They were removed from the index only, working-tree copies preserved, and root ignore coverage was extended for `.gating/.idea/` and `.gating/.commanding/log/`.
- No Git remote exists (`originConfigured=false`), so push/PR cannot be performed truthfully in this workspace.

### Iteration 5 — final acceptance target

- Commit the confirmed nested-noise cleanup and this journal update.
- Re-run post-integration quality, Canon/Gating, standalone runtime, coverage freshness, Doctrine mapping, and worktree/HEAD checks.
- Acceptance may close with one environment blocker only: actual PostgreSQL migration-currentness cannot be executed until valid local database credentials or an isolated disposable PostgreSQL instance are available.

### Iteration 5 — final acceptance result

- Post-integration `composer quality`: green — PHPStan 0 errors, PHPUnit 12/12 with 58 assertions, CS dry-run clean.
- Post-integration `composer canon:check`: green — 41 rules, 0 failed, 0 warning, 3 profile-conditional skips (Canon008/009/012) with applicability decisions recorded above.
- Post-integration standalone runtime: green on Symfony 8.1.6 / PHP 8.4.13 with `App\\Merchandising\\Kernel`.
- Post-integration Doctrine mapping validation: green.
- Fresh canonical coverage remains lines 90.6%, methods 90.7%, branches 100%; PHPDoc coverage remains classes 100%, methods 85.5%.
- `doctrine:migrations:up-to-date` was re-run and remains externally blocked by PostgreSQL authentication (`fe_sendauth: no password supplied`) for local user `app` on `127.0.0.1:5432`.
- Git remote inspection confirms there is no configured `origin`; publication/PR is therefore unavailable rather than pending.
- Signed integration commits: `570471d` (`feat: harden Merchandising for RC`) and `dd6ee8c` (`chore: finalize Merchandising RC integration`).
- RC implementation was initially accepted with an external PostgreSQL credential blocker; that blocker was subsequently resolved from the existing `www/App` environment without persisting or exposing the secret.

### PostgreSQL blocker closure

- Confirmed `www/App/tools/resolve-database-url.php` is the canonical local resolver: it boots `App/.env` through Symfony Dotenv and emits encoded connection parts without committing credentials.
- Reused that resolver transiently to provide `DATABASE_URL` to Merchandising for `composer quality:doctrine:migrations`; no password was copied into Merchandising configuration, source, journal, Git history, or command output.
- `quality:doctrine:migrations` completed with exit code 0 using the App-local credential, closing the final environment verification blocker.
- The one-off bridge helper was moved to ignored `var/` after execution and is not product tooling.
- RC implementation and verification are now fully green within the local environment; the only remaining publication limitation is the absence of a configured Git remote (`originConfigured=false`).

### Embedded Gating sync ownership closure

- Investigated the later dirty `.gating` state instead of reverting it. The embedded tree is a normal directory, not a junction or symlink.
- The changed Gating registry/rules/calibration files and new Canon043-045 implementations were compared by SHA-256 against the clean canonical `www/Gating` repository; all 9 observed code files matched byte-for-byte.
- Root cause: canonical Gating sync legitimately refreshed the embedded tool copy, while the previously added Merchandising-specific profile incorrectly lived inside that synchronized tree and was therefore deleted by sync.
- Moved Merchandising profile ownership to `.gating-profile/merchandising.json` and updated `composer canon:check` to reference the target-owned profile while continuing to use the embedded Gating runtime/policy root.
- The JSON profile keeps exact decoded migration/stale-documentation tokens without self-triggering Canon010 raw-content scanning.
- Enabled the newly current Canon043, Canon044, and Canon045 rules. All three pass: local first-party dependencies use exact `dev-master`, Objecting persisted names are entity-native, and the complete reachable local Composer repository closure is exposed.
- New Canon031 semantics exclude trivial/internal accessors from the denominator; added meaningful descriptions to the 9 real public contract methods previously carrying tags-only PHPDoc. Result: 31/31 classes and 22/22 contract methods documented (100%).
- Fresh coverage remains 90.6% lines, 90.7% methods, and 100% branches; PHPUnit now reports 12 tests / 80 assertions.
- Current Gating result: 44 rules, 0 failed, 0 warning, 3 justified profile-conditional skips (Canon008/009/012).

## RC continuation — Canon043/045 development Composer policy — 2026-09-14

### Reconnaissance and canon mapping

- Re-read target `AGENTS.md`, `README.md`, `composer.json`, architecture regression coverage, representative entities, and the prior orchestration journal.
- Re-read mandatory helper contracts for Objecting, Cruding, Viewing, and Interfacing; also checked Collectioning and Tabling because they are direct runtime dependencies and participate in the local Composer dependency closure.
- Re-read Canonization as authoritative textual policy and Gating as the executable companion. Newly materialized rules consulted: `Canon043DevelopmentComposerDependencyVersionRule`, `Canon044ObjectingSystemFieldNamingRule`, and `Canon045DevelopmentComposerRepositoryClosureRule`, plus the current architecture guard matrix.
- External merchandising benchmark reconfirmed the boundary: composition/rules/preview/lifecycle/measurement are mature merchandising concerns; recommendation ML, behavioral-data ownership, search ranking engines, product/category truth, payment, and shipping remain outside this component.
- Existing `.gating` working-tree changes were present before this pass, including a deleted Merchandising profile and in-progress Canon043-045 Gating implementation. They are treated as external/unowned changes and were not modified.

### Selected RC-critical workstream

- Bring development Composer local first-party dependency identity into Canon043 compliance without changing production-version policy.
- Preserve and regression-test the already complete Canon045 local repository closure.
- Verify Canon044 on the active Doctrine entity surface without mechanically reclassifying business fields as Objecting system fields.

### Material implementation

- Changed development `composer.json` to `minimum-stability: dev` with `prefer-stable: true`.
- Replaced all six local first-party dependency constraints with exact `dev-master`: Collectioning, Cruding, Interfacing, Objecting, Tabling, and Viewing.
- Added `options.versions[package] = dev-master` to every corresponding local symlink path repository.
- Extended `MerchArchitectureTest` to enforce the development stability policy, exact dependency constraints, symlink wiring, package-version identity, and complete six-package local repository set.
- Updated `composer.lock` with a package-scoped Composer update; first-party feature-branch lock identities were normalized to `dev-master`. Doctrine ORM also advanced from 3.7.0 to 3.7.1 as an allowed transitive update.

### Verification

- `composer validate --strict --check-lock`: manifest/lock are valid; only the pre-existing root `version` warning remains. The former local `*@dev` warning is gone.
- `composer quality`: green — PHPStan 0 errors, PHPUnit 12 tests / 80 assertions, PHP-CS-Fixer dry run clean.
- Standalone runtime: green — Symfony 8.1.6 / PHP 8.4.13, `App\\Merchandising\\Kernel` boots.
- Doctrine mapping validation: green; database synchronicity intentionally skipped by the mapping-only check.
- Composer update reported no security vulnerability advisories.
- Canon execution is currently tooling-blocked before rule evaluation because the externally modified `.gating` tree no longer contains `.gating/.gating/profile/component/merchandising.yaml`. No attempt was made to restore or overwrite that unowned dirty state.
- Canon044 factual mapping check: active Merchandising Doctrine entities use entity-native business fields and contain no `object_*`/`objecting_*` persisted property or column names.

### Growth workstream (non-blocking)

- Merchant-controlled pin/boost/bury rules with deterministic preview.
- Draft/activation lifecycle and audit diagnostics for composed surfaces.
- Placement effectiveness metrics and experimentation hooks using typed external inputs.
- Recommendation/personalization integration only through contracts; model training, behavioral event ownership, product/category truth, and search engine ownership remain outside Merchandising.

### Remaining acceptance tail

- Inspect final Git diff/status and ensure only Merchandising-owned target files from this pass are committed.
- Do not stage or commit the pre-existing `.gating` modifications/deletion.
- Re-run post-commit package quality and inspect branch/upstream state. Canon remains externally blocked until the Gating profile is restored by its owning change.

### Post-integration acceptance result

- Signed implementation commit: `9d7ee5f` (`fix: enforce dev-master component policy`). The commit contains only `composer.json`, `tests/Architecture/MerchArchitectureTest.php`, and this orchestration journal; pre-existing `.gating/**` changes were not staged.
- Post-commit `composer quality`: green — PHPStan 0 errors, PHPUnit 12/12 with 80 assertions, PHP-CS-Fixer clean.
- Fresh path coverage execution: classes 76.47%, methods 90.74%, paths 84.75%, branches 100.00%, lines 90.62%. Canon040 line/method/branch thresholds remain satisfied.
- Target PHP syntax check for the changed architecture test: green.
- Doctrine migration-currentness remains externally blocked exactly as before: PostgreSQL `127.0.0.1:5432` rejects the `app` connection because no password is supplied. No credential was invented or committed.
- Git HEAD is `9d7ee5fe3ba3a5a694f4b8995a05f05cf2dbaa05` on local `master`. There is no upstream and no configured `origin`, so push/PR publication is unavailable.
- The only remaining working-tree dirt is the pre-existing external `.gating/**` change set. The deleted Merchandising Gating profile continues to prevent `composer canon:check` from evaluating rules; this is an external tooling integration blocker, not an unresolved target-code failure.
- Under the current capability and ownership boundary, no further safe Merchandising-owned RC-critical implementation tail remains. Growth work remains intentionally post-RC.

### PostgreSQL credential re-check — 2026-09-14

- Re-checked the user-provided `www/App` credential source against the current Console runtime. Console PostgreSQL diagnostics resolve a working redacted `DATABASE_URL` and connect successfully to local PostgreSQL 16.4 database `app`.
- Direct child PHP/PowerShell processes do not receive that resolved password; `App/tools/resolve-database-url.php` currently yields an empty password outside the Console workspace-secret resolver. Repeated Doctrine migration attempts therefore fail truthfully with `fe_sendauth: no password supplied` before any Merchandising schema mutation.
- Confirmed the shared `app` database currently contains no `merch_*` tables and no `merch_migration_versions` table, so Merchandising migrations are not yet applied there.
- Replaced the hardcoded blank-password Doctrine connection with a secret-free `MERCH_DATA_DATABASE_URL` runtime override and local fallback URL. No credential is persisted or logged.
- Retained `bin/merch-db-bootstrap.ps1` only as an explicit process-env consumer; it no longer attempts to cross the Console workspace-secret boundary. Added `/.console-mcp/` to `.gitignore` for bounded-run artifacts.
- Current remaining blocker is capability-level credential injection into the Merchandising Doctrine process, not missing credentials in App and not a target-code defect.

### Canonical dual-runtime and vocabulary correction — 2026-09-14

- Reaffirmed the canonical runtime contract: every component may run standalone with its own local credentials/configuration, or as a reusable bundle inside `App`, where it uses host-provided Doctrine/DBAL infrastructure. No third credential-bridge mode is allowed.
- Removed `bin/merch-db-bootstrap.ps1` from the product tree. Merchandising no longer attempts to resolve, copy, or bridge host credentials from `App`; standalone database configuration remains environment-driven and bundle mode remains host-owned.
- Confirmed `MerchBundle` is infrastructure-neutral and does not import standalone Doctrine package configuration into the host.
- Removed the `Surface` token from current component-owned runtime and contract names: `MerchController`, `MerchRequestDTO`, `MerchEntity`, `MerchProvider`, `MerchProviderInterface`, `MerchRepository`, and `MerchView` are now canonical.
- Renamed route/config and contract artifacts to `config/routes/merch_routes.yaml` and `delivery/contracts/merchandising-output.schema.json`; updated payload/contract vocabulary to `merch` / `merchandising.output.v1`.
- Renamed the primary persistence table to `merch_composition` with `merch_key` and `type`, preserving the required `merch_` database prefix without reintroducing `Surface`.
- Updated target-owned Gating profile to remove obsolete Surface-bearing legacy/stale names while keeping the current `Merch` subject vocabulary authoritative.
- Verification: `composer quality` green (PHPStan 0 errors, PHPUnit 12/12 with 80 assertions, CS clean); fresh coverage green at 90.6% lines, 90.7% methods, 100% branches; `composer canon:check` green with 44 rules, 0 failed, 0 warning, 3 justified profile-conditional skips; standalone Symfony 8.1.6 / PHP 8.4.13 boot green; Doctrine mapping green.

## RC continuation — deterministic candidate aggregation — 2026-09-20

### Baseline and selected work

- Re-read current repository governance, Composer/runtime configuration, all architecture notes, source/output contracts, persistence baseline, candidate collector/provider, tests, and the active Gating profile.
- Verified clean Git `master` baseline at `b0ce6f361a2550d74c75cfb9cda45b3693aaf924`; no upstream is configured.
- Re-read mandatory Objecting, Cruding, Viewing, and Interfacing contracts, plus Gating executable ownership and the relevant Canonization normative rules.
- Market/maturity comparison keeps scheduled rules, pin/boost/bury/hide, intelligent ranking, experimentation, and analytics in the separate growth stream; RC work remains correctness-oriented.
- Selected RC gap: `MerchCandidateCollector` accepted non-positive limits, which could expose PHP negative-slice behavior, while overlapping registrations could also produce duplicate source identities and registration-order-sensitive ties.

### Canonization mapping

- Canon008: no new foreign namespace/package edge.
- Canon011: source exceptions remain observable; no blanket catch or success-like fallback is introduced.
- Canon012: request and candidate boundaries remain typed DTO/value-object contracts.
- Canon017: architecture documentation is updated to match the aggregation runtime guarantees.
- Canon018/020: `App\\Merchandising\\`, `Merch*`, and role-first placement remain unchanged.
- Canon021: no generic CRUD machinery is introduced.
- Canon022/023/024/025: standalone dependency baseline, development symlinks, packaged production dependencies, and dual-runtime surfaces remain unchanged.
- Canon039/040: PHPUnit and persistent coverage remain executable acceptance evidence.
- Canon043/045: current `dev-master` sibling identity and root local repository closure remain unchanged.

### Material implementation

- Reject non-positive candidate limits before source invocation.
- Deduplicate display-safe candidates by `sourceComponent + sourceType + sourceId`.
- For duplicate source identities, retain the strongest-priority candidate using a deterministic comparison.
- Sort equal-priority output by stable source identity and candidate key instead of Symfony service registration order.
- Added unit regression coverage and documented the aggregation guarantees.

### Material risks and gates

- Ordering changes only for equal-priority candidates or duplicate owner identities; this is intentional deterministic behavior.
- Source failures remain fail-fast under Canon011; fallback/observability policy is a separate design concern.
- The pre-existing strict Composer advisory for the root `version` field is tracked separately from runtime correctness.
- Gates: changed-file PHP lint, PHPUnit, PHPStan, PHP-CS-Fixer dry run, fresh coverage, Gating/Canonization, Composer validation/check-lock, standalone runtime, Doctrine mapping, and migration-currentness.

### Verification result

- Changed-file PHP lint: green for collector and regression test.
- `composer quality`: green — PHPStan 0 errors, PHPUnit 14/14 with 85 assertions, PHP-CS-Fixer dry-run clean.
- Fresh path coverage: lines 91.3%, methods 91.1%, branches 100.0%; all Canon040 thresholds are satisfied.
- `composer canon:check`: green — 44 rules, 0 failed, 0 warning, 3 profile-conditional skips (Canon008/009/012), unchanged from baseline applicability.
- Standalone runtime: green — Symfony 8.1.6 / PHP 8.4.13 with `App\\Merchandising\\Kernel`.
- Doctrine mapping: green. Migration-currentness is environment-blocked before any schema work because local PostgreSQL rejects the process with `fe_sendauth: no password supplied`.
- Normal Composer validate/check-lock: green. Strict validation reports only the pre-existing advisory that a root `version` field is present.
- Diff ownership: exactly four Merchandising-owned files are dirty; no unrelated or helper-repository mutation is present.
- Git remote inspection: no `origin` is configured, so publication/PR is unavailable in this workspace after local integration.

## 2026-09-22 — Composer Gating migration and behavioral acceptance

- Removed the embedded Gating runtime/policy tree from consumer `.gating/`; `.gating/` is now artifact-only with a repository marker README.
- Moved repository-specific Gating profile ownership into `config/merch_gating_profile.json` and switched `composer canon:check` / `gate` to the Composer-installed `vendor/bin/gating` runtime.
- Updated the consumer to current Gating `dev-master` with Canon052 integration and owner-side generic guard alignment.
- Completed Canon041 tooling with Symfony Test Pack, Panther, repository-local Playwright config, and a real HTTP smoke test.
- Added a canonical standalone `public/index.php`; corrected HTTP bootstrap to honor process-level `APP_ENV` / `APP_DEBUG`, eliminating the web/CLI container divergence found by Playwright.
- Added Symfony functional HTTP coverage and a reproducible Canon042 evidence producer based on explicit repository-owned test inventories.
- Aggregate `composer quality`: GREEN. PHPStan 0 errors; PHPUnit 15/15 with 87 assertions; PHP-CS-Fixer clean; Playwright 1/1; Canon040/041/042/052 pass; Gating 68 rules, 0 failed, 0 warning.
- Generated `config/reference.php` remains local and intentionally untracked under Canon037.

### 2026-09-22 strict Composer RC closure

- Fresh baseline was clean on local `master`; no Git remote/upstream is configured.
- Re-checked Canonization package identity, dual-runtime, development symlink, production package, quality, test, and Gating-integration rules against the current tree.
- `composer validate --strict --check-lock` exposed one remaining RC packaging defect: the manually declared root `version` field.
- Removed the redundant `version` field from both `composer.json` and `composer.prod.json`; package version remains VCS/package-manager derived.
- This is packaging hardening only; no merchandising runtime behavior or neighboring component ownership changed.
- Added `/config/reference.php` to `.gitignore` because quality/runtime inspection generates it locally and Canon037 requires it to remain outside source control.
- Final quality: PHPStan clean; PHPUnit 15/15 with 87 assertions; PHP-CS-Fixer clean; Playwright 1/1; behavioral evidence generated; Gating 68 rules, 0 failed, 0 warning.
- Final `composer validate --strict --check-lock`: PASS after lock content-hash synchronization with 0 package updates.

## 2026-09-22 — Current RC verification refresh

- Re-read current governance, Composer/runtime configuration, architecture/source/output contracts, dependency contour, Canonization/Gating constraints, and clean Git baseline.
- Current RC diagnostic: GREEN with 0 canon issues.
- Market contour remains bounded to deterministic storefront composition, placement/order, source-backed candidates, and stable renderer-neutral output; merchant experimentation/personalization/ranking analytics remain growth.
- `composer quality`: PASS; PHPStan clean, PHPUnit 15/15 with 87 assertions, CS clean, Playwright 1/1, behavioral evidence generated, Gating 68 rules with 0 failed / 0 warning.
- Fresh coverage: lines 96.3%, methods 94.6%, branches 88.4%; Canon040 passes.
- Standalone Symfony runtime and Doctrine mapping validation: PASS.
- `doctrine:migrations:up-to-date`: environment-blocked only because the current process has no PostgreSQL password for 127.0.0.1:5432; no target defect is reported and no credential is invented or persisted.
- No Merchandising source change is justified by this pass.

## 2026-09-24 — Canon052 consumer Gating isolation closure

### Reconnaissance and baseline

- Re-read the current Merchandising governance, architecture/source-contract documentation, Composer manifest, orchestration journal, mandatory Objecting/Cruding/Viewing/Interfacing dependency contour, Gating enforcement, and current Canonization rules relevant to this repository.
- Market comparison kept merchant ranking rules, pin/boost/bury/hide, scheduling, preview, experimentation, and behavioral ranking in the growth stream; the RC stream remains correctness, deterministic composition, packaging, and executable canon compliance.
- Current Git baseline was synchronized with `origin/master` at `4fd5a1972724d7d01892049eca85a7d0f4b5846c`, with pre-existing changes in `composer.json` and a materialized `.gating/` tree.
- Canon mapping consulted/applied: Canon018 package/subject identity; Canon020 Symfony role roots; Canon022 standalone dependency baseline; Canon040 executable coverage; Canon041/042 behavioral/UI testing and evidence; Canon043 local `dev-master` identity; Canon045 local repository closure; Canon052 Gating consumer integration; Canon053 sibling symlink isolation.
- Mandatory runtime dependency contour remains present directly in `composer.json`: Objecting, Cruding, Viewing, Interfacing, plus Collectioning, Tabling, EasyAdmin and Gating as required by the standalone baseline.

### RC-critical workstream

- Fresh `composer quality` and `composer canon:check` isolated one blocking defect: Canon052 rejected the consumer `.gating/` directory because it contained a full executable/materialized Gating repository rather than generated artifact state.
- PHPStan, PHPUnit, PHP-CS-Fixer, Playwright, behavioral coverage, Canon040/041/042, Canon043/045, Canon053, route/database/namespace checks were otherwise green.
- The materialized `.gating/` tree was moved intact to `var/gating-materialized-20260924` so no source material was destroyed, and the canonical artifact-only `.gating/README.md` marker was restored.

### Growth workstream

- Post-RC maturity remains merchant-authored ranking policies, scheduled rules, preview/simulation, experimentation, analytics, and behavioral ranking inputs through typed source contracts.
- These features must not move product/category/vendor truth, search indexing ownership, or neighboring persistence into Merchandising.

### Что имеем? Что осталось?

The single fresh RC blocker has been remediated without changing merchandising runtime semantics or deleting the quarantined materialized Gating tree. Remaining work is acceptance verification, diff review, signed integration, publication, and final post-integration state inspection.


