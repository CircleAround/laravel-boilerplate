# これは何ですか？

Laravel のトレーニング用ボイラープレートです。

## ブランチについて
開発用のリポジトリではないので、ブランチ管理が少し独特です。トレーニングする際に促されるので、指定のブランチから学習を開始してください。

### 学習用ブランチ

以下は各種バージョンに対応した学習用ブランチです。学習するための最低限の実装が入っています。

- https://github.com/CircleAround/laravel-boilerplate/tree/base-php8-laravel9-node18-vue3

### バージョンブランチ

以下は各種バージョンの基本ブランチです。基本的に環境構築のみが行われていて、実装は入っていません

- https://github.com/CircleAround/laravel-boilerplate/tree/version-php8-laravel9-node18-vue3

# 使い方

## 準備
- 利用のOS環境でのDocker環境
- VSCode

## コードの取得

このリポジトリに直接変更することは禁じられています。

- `git clone` した後、 `.git` ディレクトリを削除してGitの管理から外します。その後改めてご自身のリポジトリを作成してpushしてください。
- GitHubの操作に明るい人であれば、Template機能を使って新たなリポジトリを作成できるはずです。

## 起動方法
VSCodeの Dev Container機能が有効になっています。プロジェクトをVSCodeで開くと Dev Containerで再度開く旨が通知されるので、OKしてください。この時点でシステムは稼働していて、ソースコードを変更するとその変更がシステムに反映されるはずです。
