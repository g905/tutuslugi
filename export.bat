git diff --name-only 50be1f1d^ ^4f41a21f^ > diff.txt
SET /p DIFF=<diff.txt
git archive -o archive.zip 50be1f1d^ %DIFF%
DEL diff.txt
