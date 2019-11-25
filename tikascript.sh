for file in /home/andrew/Downloads/Yahoo/yahoo/*
do
  java -jar tika-app-1.20.jar --text-main "$file" >> big.txt
done
