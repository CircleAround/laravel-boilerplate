# これは何ですか？

Laravel のトレーニング用ボイラープレートです。実際の開発にありそうな設定等を用意してあり、実務に近い開発を学習するための最初のコードを提供します。

- https://laravel.com/docs/10.x/installation#getting-started-on-macos で使われる https://laravel.build/example-app の内容を調整して作成しています。
- formatter、lint 等の設定がなされており、 GitHub Actions で　 CI が動作します。
- フロントエンド開発の環境を追加しています。

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

ご自身のマシンに以下の環境が整っている前提ですので、インストールして整えてください。

- Docker 環境
- VSCode

## コードの取得

このリポジトリを直接変更することは禁じられています。例えば以下のどちらかのような方法で、ご自身のリポジトリに学習用ブランチの内容を移植して使ってください。

- `git clone` した後、 `git switch` 等で利用したいブランチに移動した上で `.git` ディレクトリを削除して Git の管理から外します。その後改めてご自身のリポジトリを作成して `git push` してください。
- GitHub の操作に明るい人であれば、Template 機能を使って新たなリポジトリを作成できるはずです。 `git clone` して開発を開始できます。

## 起動方法

VSCode の Dev Container 機能が有効になっています。プロジェクトを VSCode で開くと Dev Container で再度開く旨が通知されるので、OK してください。この時点でシステムは稼働していて、ソースコードを変更するとその変更がシステムに反映されるはずです。
