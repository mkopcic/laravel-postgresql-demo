# Redis Cache u Laravel projektu

Ovaj dokument objašnjava zašto u trenutnom projektu koristimo Redis za cache i kako je konfiguriran.

## Zašto Redis

- Redis je brži od baze podataka za cacheirane stavke i kratkotrajne podatke.
- Laravel cache driver `database` radi, ali podatke sprema u tabelu i nije optimiziran za visoke performanse.
- Redis je prirodan izbor za:
    - application cache
    - rate limiting
    - session store
    - queue backend (kasnije)
    - real-time features

## Trenutna konfiguracija

U `.env` koristimo:

```dotenv
CACHE_STORE=redis
CACHE_PREFIX=laravel_cache
REDIS_CLIENT=predis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379
```

## Kako radi

Laravel sada koristi Redis cache store umjesto `database` cache store-a. To znači:

- `cache()->put(...)` i `cache()->get(...)` koriste Redis
- `CACHE_PREFIX` sprečava sudare ključeva ako postoji više Laravel aplikacija na istom Redis serveru
- `predis/predis` je instaliran jer PHP CLI nije imao ekstenziju `phpredis`

## Što je važno znati

- Redis server je pokrenut lokalno u Laragon okolini.
- Ako kasnije želiš prebaciti queue na Redis, trebaš samo promijeniti `QUEUE_CONNECTION=redis` i postaviti `REDIS_CLIENT`.
- Ostale konfiguracije (`SESSION_DRIVER=database`) ostaju nepromijenjene dok ne odlučiš prebaciti sesije i queue.

## Korak provjere

Test izvršenjem u Laravelu:

```php
cache()->put('redis_test_key', 'redis_ok', 10);
echo cache()->get('redis_test_key');
```

Ako vraća `redis_ok`, Redis cache je uspješno konfiguriran.
