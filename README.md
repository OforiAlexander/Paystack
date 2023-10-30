# Paystack Integration [![CI]()]

## Set-up Instructions

### Clone the repo
```
gh repo clone Alexander Ofori/Paystack
```
or

```
git clone https://github.com/OforiAlexander/Paystack.git
```
<br>

### Install dependencies
```
composer install && npm install
```
<br>

### Create .env file
```
cp .env.example .env
```
<br>

### Generate application key
```
php artisan key:generate
```
<br>

### Edit .env 
<br>

### Migrate and Seed the database
```
php artisan migrate --seed
```
<br>

### Create Storage link
```
php artisan storage:link
```
<br>


### Launch application
```
php artisan serve
```
<br>
