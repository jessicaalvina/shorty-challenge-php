
# Ralali PHP Microservice Boilerplate

### Pendahuluan
Dengan adanya kebutuhan untuk memecah Arsitektur Ralali yang Monolitik menjadi microservice, maka hadirlan boilerplate ini yang dapat digunakan oleh internal tim ralali untuk menunjang pembangunan microservice menggunakan bahasa pemrograman Go, arsitektur pada mikroservice ini diadoptasi berdasarkan teori yang ada pada link-link berikut ini:

- https://blog.cleancoder.com/uncle-bob/2012/08/13/the-clean-architecture.html
- http://www0.cs.ucl.ac.uk/staff/A.Finkelstein/crsenotes/1B1499REQTS.pdf

### Architecture Structure
![architecture diagram](storage/golang%20architecture%20diagram.png)
```
- rl-ms-boilerplate-php
 |- constants
 |- controllers
 |- helpers
 |- middlerware
 |- models
 |- repositories
 |- services
 |- storage
    |- logs
```
#### middleware

Digunakan untuk menyimpan middleware-middleware yang akan digunakan, contoh `cors_middleware` atau `oauth_middleware`.

#### controllers

Controller bertugas untuk menghandle HTTP Request, routing dimasukkan per-controller dan digroup berdasarkan controller, controller terhubung dengan service.

#### service

Service bertugas untuk menghandle business logic, service memungkinkan untuk memanggil banyak repository dan atau service lain.

#### repositories

Repository bertugas untuk menghandle query-query ke database atau storage lainnya, jangan menambahkan logic-logic programming berat pada layer ini.

#### models

Models bertugas untuk menampung model-model representasi database schema yang dapat digunakan untuk kepentingan migration atau enkapsulasi data.

#### helpers

Bertugas untuk menyimpan helpers atau libraries yang sering digunakan contohnya `error_helper` atau `redis_helper`.

#### constants

Digunakan untuk menyimpan constant-constant seperti `error_constants` atau `configuration_constants`.

#### storage

Storage bertugas untuk menyimpan file-file seperti log error atau temporary file storage.

## TODO
- Endpoint documentation
- Authorization middleware

## How to Setup

 
#### Setup Local


#### Setup Using Dockerfile


### Unit Testing
untuk menjalankan unit testing, developer dapat menjalankan command dibawah ini:
```
./vendor/bin/phpunit
``` 

### Code Versioning
versioning level dilakukan pada layer 
- `controllers` 
- `repositories` 
- `services`

setiap file pada layer-layer tersebut diberi prefix version dengan format snake case, seperti pada contoh yang ada `v1_user_controller.go` yang berarti user_controller versi 1, dan pada level struct diberi prefix versi dalam bentuk upper camel case seperti pada contoh diproject ini `V1UserController` yang berarti controller `UserController` versi 1.

##### Sample Case
terdapat contoh kasus pada saat update data user parameter dan response yang diterima dan diberikan oleh `v1` dan `v2` berbeda, pertama-tama, developer harus melakukan definisi DTO nya terlebih dahulu pada layer `objects`:

- v1_user_object.go
- v2_user_object.go

pada kedua file tersebut terdapat object response dan object request, setelah melakaukan devinisi DTO, developer kemudiam melakukan definisi repository pada layer `repository` yang menggunakan DTO pada masing-masing versi.

setelah melakukan definisi pada `repository`, kemudian dilakukan definisi pada layer `service` dan `controller`, perhatikan routing group pada masing masing controller harus sesuai dengan versi yang didefinisikan.    

### Database Migration
untuk menjalankan database migration, developer dapat menjalankan command dibawah ini:
```
go run database_migration.go
``` 
database migration akan melakukan sinkronisasi skema dan indeks database berdasarkan skema yang dibuat pada directory models dan perintah yang ada di `database_migration.go`
