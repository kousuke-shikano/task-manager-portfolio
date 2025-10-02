# Task Manager (Laravel + Docker)

## 概要
- Laravel 10 + Docker で構築したタスク管理アプリ
- ユーザーごとのタスク管理、優先度・ステータス管理、CRUD 操作可能
- ポートフォリオ用に作成

## 環境
- PHP 8.2
- Laravel 10
- MySQL 8
- Docker / docker-compose

## 起動方法
1. リポジトリをクローン
```bash
git clone <リポジトリURL>
cd task-manager

2. Docker 起動
docker-compose up -d

3. アプリケーションにアクセス
http://localhost:8080

サンプルアカウント

メールアドレス: test@test.com
パスワード: password
※万が一通らなかったら
http://localhost:8080/register
で新規にアカウントを作ってください