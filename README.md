
# フェイスブック　グラフAPI　sampleコード

## :green_book: 概要

FacebookのグラフAPIを使用し、ログイン→名前とIDを取得する簡単なコード。

## :green_book: 開発環境

- php  
- Docker  
- facebook/php-sdk  ※こちらをダウンロードし、htmlフォルダに設置してください。
- VSCode（Visual Studio Code）  

## :green_book: 画面遷移

### 1、ログイン

ログイン画面が表示され、ログインボタンを押すと、Facebookログイン画面へ遷移。

![booksearch](https://user-images.githubusercontent.com/27414699/100981793-9e264800-358a-11eb-9ee0-f95d12b58d32.png)

### 2、Facebookログイン

Facebookへログイン状態でない場合、こちらの画面からログインします。

![knsk](https://user-images.githubusercontent.com/27414699/100981901-c150f780-358a-11eb-89ff-f6ea9dc7edeb.png)

### 3、名前、IDの表示 

Facebookに登録されている、名前、IDが表示されます。

![knskkk](https://user-images.githubusercontent.com/27414699/100981950-d0d04080-358a-11eb-9097-e683e84f5e66.png)

## :green_book: 使用方法
**1、Dockerコマンドの実行**  
・ルート直下で、下記のDockerコマンドを実行します。

docker-compose up -d

**2、ページにアクセス**  
http://localhost:8000/
