# Laravel AI Startup Stack 2026

Ovo je preporučeni PHP/Laravel ekvivalent Python AI stacku:

FastAPI + Celery + RabbitMQ + PostgreSQL + Redis + PyTorch

## Cilj

Sastaviti moderni Laravel AI stack s fokusom na:

- poslovnu aplikaciju kao orkestrator
- AI integracije i agenti
- skalabilne zadatke u pozadini
- real-time observabilnost i monitoring
- vector search / RAG sa PostgreSQL + pgvector
- brzi razvoj admina i UI-a

---

## Predloženi stack

### Core application

- Laravel 12
- PHP 8.4+
- PostgreSQL kao primarna baza
- Redis za cache, sessions, queues i rate limiting

### Background processing

- Laravel Queue
- Redis queue za start i manje workload-e
- RabbitMQ kao sljedeći korak za microservices / multi-node
- Laravel Horizon za pregled i monitoring worker-a

### Real-time / event-driven

- Laravel Reverb za event broadcasting
- Laravel Echo za websocket klijente
- Pub/sub stil arhitekture za employee monitoring, live dashboard-e, agent status i notifikacije

### Observability

- Laravel Pulse za aplikacijski monitoring
- Laravel Telescope za lokalnu dijagnostiku
- Prometheus + Grafana za metrice
- Loki za log agregaciju

### Search / vector / RAG

- Laravel Scout kao search abstrakcija
- Meilisearch za brzo full-text pretraživanje
- PostgreSQL + pgvector za AI memory i vector search
- pgvector je odličan fit za startup koji želi odmah koristiti PostgreSQL bez dodatnog sloja

### AI integration layer

- Laravel AI SDK za pozivanje LLM-ova i chainova
- MCP Server kao alatni sloj za orkestraciju, promptove i backend taskove
- OpenAI API kao glavni cloud fallback
- Anthropic PBC API kao sekundarni provider
- Ollama lokalni modeli kada treba “on-prem / edge” AI

### Workflow / agents

- Laravel queues + events za workflow pipeline-e
- Sagas / stateful workflow patterni za kompleksnije poslovne procese
- Agent-based workflow za:
    - SAP sync
    - invoice OCR
    - email classification
    - CRM automation
    - employee monitoring

### Admin UI

- Filament 4 za admin panel
- Livewire 4 za interaktivne forme i dashboard-e
- Tailwind CSS za UI styling

### Deployment

- Docker za razvoj i deploy
- Traefik kao edge proxy
- Cloudflare Tunnel za siguran pristup development / staging instanci
- Hetzner bare metal ili Hetzner Cloud za proizvodnju

---

## Preporučena arhitektura i bounded contexts

### 1. Core domain

Središnji domain koji drži:

- korisnike i autorizaciju
- poslovne entitete
- primarnu logiku
- database model

### 2. Queue / background context

Odvoji:

- jobove
- worker orchestration
- retry / failure handling
- analytics metrice

### 3. AI / model context

Sloj koji upravlja:

- prompt pipeline-ima
- model providerima
- vector memory
- RAG upitima
- AI response validation

### 4. Search / memory context

Sloj za:

- indeksiranje dokumenta
- pretraživanje full-text i vektorsko
- Meilisearch / PostgreSQL / pgvector synchronizaciju

### 5. Observability / monitoring

Sloj za:

- operativnu vidljivost
- health checks
- worker metrics
- log aggregation

### 6. Admin / ops UI

Panel za:

- worker status
- agent kontrolu
- audit logove
- model provider konfiguraciju
- dnevne statuse i informacije o sistemu

---

## Folder structure prijedlog

```
app/
  Actions/
  Agents/
  AI/
    Providers/
    PromptBuilders/
    Workflows/
  Console/
  Events/
  Http/
    Controllers/
    Requests/
    Resources/
  Jobs/
  Listeners/
  Models/
  Notifications/
  Policies/
  Queries/
  Repositories/
  Services/
  Support/
  ViewModels/

database/
  migrations/
  seeders/

resources/
  views/
  js/
  css/

routes/
  api.php
  web.php
  mcp.php

config/
  ai.php
  vector.php
  search.php
  queue.php

```

### Fokus folder structure

- `app/AI/` za sve AI-specific slojeve
- `app/Agents/` za poslovne agente i orkestraciju
- `app/Jobs/` za queue zadatke i async workflow-e
- `app/Queries/` za pretrage i RAG upite
- `app/Services/` za vanjske integracije: OpenAI, Ollama, Anthropic, Scout, Meilisearch

---

## Service layer i ključni moduli

### AI provider layer

- `App\AI\Providers\OpenAIProvider`
- `App\AI\Providers\AnthropicProvider`
- `App\AI\Providers\OllamaProvider`
- `App\AI\Providers\ModelSelector`

### Prompt / chain builder

- `App\AI\PromptBuilders\...`
- `App\AI\Workflows\...`
- `App\AI\PromptTemplates` ili `app/Support/Prompts`

### Vector memory / retrieval

- `App\Queries\VectorSearchQuery`
- `App\Services\PgVectorService`
- `App\Services\SearchIndexer`

### Workflow / saga orchestrator

- `App\Agents\...`
- `App\Jobs\WorkflowStepJob`
- `App\Events\Workflow*`
- `App\Listeners\...`

### Monitoring / operations

- `App\Services\Monitoring\PrometheusExporter`
- `App\Services\Monitoring\LogPipeline`
- `App\Http\Controllers\Admin\HealthController`

---

## Prvi koraci implementacije

1. Postavi Laravel 12 + PostgreSQL + Redis
2. Konfiguriraj `queue.default=redis`
3. Instaliraj `laravel/horizon`, `laravel/scout`, `meilisearch-php`, `spatie/laravel-schemaless-attributes` ili `pgvector` support package
4. Dodaj `laravel/ai` i `laravel/mcp`
5. Napravi `config/ai.php`, `config/vector.php`, `config/search.php`
6. Kreiraj basic agent workflow za async OCR / classification
7. Uvedi `pgvector` za AI memory i dokument search
8. Dodaj monitoring sa `telescope` + `pulse`

---

## Zašto ovaj stack?

- Laravel je kompletan poslovni framework, idealan za brzo gradnju produkcijskih aplikacija.
- Redis + queue + Horizon pružaju robustan async backend bez potrebe za Python-only stackom.
- PostgreSQL + pgvector omogućuju vektorsku memoriju bez dodatnog engine-a.
- MCP + Laravel AI daju jasnu separaciju između aplikacije, orchestration layer-a i model providers.
- Filament + Livewire oslobađa brzoj izradi admina i operativnih dashboard-a.

---

## Napomena

Ako želiš, sljedeći korak je napraviti konkretni `folder structure + bounded contexts + services + AI agents` plan u stilu projekta, s primjerima fajlova i mapiranjem prema tvojim poslovnim use-case-ovima.
