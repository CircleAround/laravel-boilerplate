#!/bin/bash

# 検証対象のディレクトリパスを指定
DIRECTORY="."

# エラーがある場合は終了ステータスを1に設定する
ERRORS_FOUND=0

# ディレクトリ内の *.php ファイルに対して、php -l を実行
while IFS= read -r -d '' file; do
  if [ "$(basename "$file")" = "*.blade.php" ]; then
    continue
  fi
  if ! php -l "$file" | grep -q "^No syntax errors detected in "; then
    ERRORS_FOUND=1
  fi
done < <(find "$DIRECTORY" -name "*.php" \
  ! -path "*/vendor/*" \
  ! -path "*/frontend/*" \
  ! -path "*/storage/*" \
  -print0)

# エラーがあった場合は終了ステータスを1に設定する
if [ "$ERRORS_FOUND" -eq 1 ]; then
  exit 1
fi
