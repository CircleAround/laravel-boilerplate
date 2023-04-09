#!/bin/bash

# 検証対象のディレクトリパスを指定
DIRECTORY="."

# エラーがある場合は終了ステータスを1に設定する
ERRORS_FOUND=0

# ディレクトリ内の *.php ファイルに対して、php -l を実行
find "$DIRECTORY" -name "*.php" \
  ! -path "*/vendor/*" \
  ! -path "*/frontend/*" \
  ! -path "*/storage/*" \
  ! -name "*.blade.php" \
  -exec sh -c '
    if php -l "$1" | grep -q "^No syntax errors detected in "; then
      :
    else
      php -l "$1"
      ERRORS_FOUND=1
    fi
  ' sh {} \;

# エラーがあった場合は終了ステータスを1に設定する
if [ "$ERRORS_FOUND" -eq 1 ]; then
  exit 1
fi