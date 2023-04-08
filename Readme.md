# support-my-home-consideration

マイホーム検討支援システム

## overview

## 環境

- Laravel 9.\*
- Mysql 8.0
- React
- Typescript
  <br>
  <br>

## installation

- clone

  ```
  $ git@github.com:VinousTy/support-my-home-consideration.git`
  ```

  ```
  $ cd support-my-home-consideration
  ```

- install

  ```
  make install
  ```

- コンテナの状態を確認

  ```
  make ps
  ```

  <br>

## How to

- コンテナの状態を確認

  ```
  make ps
  ```

- コンテナを起動する

  ```
  make up
  ```

- コンテナにアタッチする

  ```
  make shell
  ```

- 作成した OpenAPI の情報を確認する。

  ```
  make generate
  ```

  確認には、Swagger UI を使用します。<br>

  | サービス   | URL                    |
  | ---------- | ---------------------- |
  | Swagger UI | http://localhost:8081/ |

  <br>

## push 前にやること

- formattr を実行しコードがフォーマットされていることを確認
  ```
  make format
  ```
