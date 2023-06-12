
# Hajans Case





## Kurulum

Gönderilen ZİP Dosyasını Arşivden çıkarın ve kullanmış olduğunuz local sunucunuzun www veya htdocs dizinin altına yapıştırınız.

hajans_case sql dosyasını oluşturduğunuz veritabanınıza import ediniz.

config clasörü altında bulunan define.php açarak veritabanı bilgilerinizi güncelleyiniz.

Postman Collection Dosyasını Postman Uygulamamıza Import ediniz.

Kurulum Başarıyla Tamamlanacaktır.

  
## İşleyiş

**Controller:** Gelen Tüm isteklerin karşılanıp gerekli validation'dan sonra Model'aktarıldığı ve dönüş değerlerinin view'a gönderildiği bölümdür.

**Model:** Db işlemlerinin ve objelendirmelerin yapıldığı bölümdür.

**Interface:** ApiInterface ile bağımlı olunması gereken methodlarımızın olduğu bölümdür.Ben  modelde ortak kullanılan 3 method için uyguladım.

**View:** Dönen değerlerin temamızda gösterildiği bölümdür.

**index:** Controller-Model-View senkranizasyonu için geniş bir logic yerine require edilmiş dosyaları derleryen bölümdür.

Kod içerisinde methodlar ve işlevleri ile alakalı description eklendi.
## API Kullanımı

Detaylı Kullanım Postman Collection Dosyasında Mevcut

#### Ürün Arama

```http
  POST /productsearch
```

#### Kategoriye Göre Ürün Listeleme

```http
  POST /producttocategory
```


#### Stok Bazlı Ürün Listeleme

```http
  POST /productstock
```

#### Ürün Ekleme

```http
  POST /addproduct
```


#### Ürün Düzenleme

```http
  POST /editproduct
```


#### Ürün Silme

```http
  POST /deleteproduct
```


#### Kategori Ekleme

```http
  POST /addcategory
```


#### Kategori Düzenleme

```http
  POST /editcategory
```


#### Kategori Silme

```http
  POST /deletecategory
```

#### Stok Ekleme

```http
  POST /addstock
```


#### Stok Düzenleme

```http
  POST /editstock
```


#### Stok Silme

```http
  POST /deletestock
```
