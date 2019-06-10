#!/bin/bash

file="user_$1.csv"

page_1="http://192.168.1.1/sqlite_platform/src/index.html"
page_2="http://192.168.1.1/sqlite_platform/src/profile/index.php"
page_3="http://192.168.1.1/sqlite_platform/src/register/proc.php"

mkdir -p ../generated_csv/per_user_per_page/
mkdir -p ../generated_csv/per_user/
mkdir -p ../generated_csv/per_page/
mkdir -p ../../graphs/generated_graphs/per_user_per_page/

touch ../generated_csv/per_user_per_page/user_$1.csv
touch ../generated_csv/per_user/user_$1.csv
dest_1="../generated_csv/per_user_per_page/user_$1.csv"
dest_2="../generated_csv/per_user/user_$1.csv"
dest_3="../generated_csv/per_page/user_$1.csv"
dest_test="../generated_csv/user_time.csv"
dest_test_2="../generated_csv/user_time_page.csv"
echo "user_number,url_number,avg_latency_time" > $dest_1
echo "user_number,avg_latency_time" > $dest_2
echo "url_number,avg_latency_time" > $dest_3

sum_url_1=0
sum_url_2=0
sum_url_3=0

ping_url_1=0
ping_url_2=0
ping_url_3=0

for i in $(seq 1 $1)
do
	echo "################# USER $i ################"
	echo "----------------- Page 1 -----------------"
	sum_1="$(grep "bzm - Concurrency Thread Group 1-$i" "$file" | cut --complement -d "," -f1,5,7,9 | grep "$page_1" | awk -F "," -v accum_input="$1" -v accum_page="$page_1" '($9=accum_input)&&($10=accum_page){sum+=$11}; END {print sum}')"
	ping_1="$(grep "bzm - Concurrency Thread Group 1-$i" "$file" | cut --complement -d "," -f1,5,7,9 | grep "$page_1" | awk -F "," -v accum_input="$1" -v accum_page="$page_1" '($9=accum_input)&&($10=accum_page){print $11}' | wc -l )"
	echo "sum is "$sum_1 " & ping is " $ping_1
	sum_url_1=$(($sum_url_1+$sum_1))
	ping_url_1=$(($ping_url_1+$ping_1))
	echo "$i,1,$(echo $sum_1/$ping_1 | bc -l)" >> $dest_1

	echo "----------------- Page 2 -----------------"
	sum_2="$(grep "bzm - Concurrency Thread Group 1-$i" "$file" | cut --complement -d "," -f1,5,7,9 | grep "$page_2" | awk -F "," -v accum_input="$1" -v accum_page="$page_2" '($9=accum_input)&&($10=accum_page){sum+=$11}; END {print sum}')"
	ping_2="$(grep "bzm - Concurrency Thread Group 1-$i" "$file" | cut --complement -d "," -f1,5,7,9 | grep "$page_2" | awk -F "," -v accum_input="$1" -v accum_page="$page_2" '($9=accum_input)&&($10=accum_page){print $11}' | wc -l )"
	echo "sum is "$sum_2 " & ping is " $ping_2
	sum_url_2=$(($sum_url_2+$sum_2))
	ping_url_2=$(($ping_url_2+$ping_2))
	echo "$i,2,$(echo $sum_2/$ping_2 | bc -l)" >> $dest_1

	echo "----------------- Page 3 -----------------"
	sum_3="$(grep "bzm - Concurrency Thread Group 1-$i" "$file" | cut --complement -d "," -f1,5,7,9 | grep "$page_3" | awk -F "," -v accum_input="$1" -v accum_page="$page_3" '($9=accum_input)&&($10=accum_page){sum+=$11}; END {print sum}')"
	ping_3="$(grep "bzm - Concurrency Thread Group 1-$i" "$file" | cut --complement -d "," -f1,5,7,9 | grep "$page_3" | awk -F "," -v accum_input="$1" -v accum_page="$page_3" '($9=accum_input)&&($10=accum_page){print $11}' | wc -l )"
	echo "sum is "$sum_3 " & ping is " $ping_3
	sum_url_3=$(($sum_url_3+$sum_3))
	ping_url_3=$(($ping_url_3+$ping_3))
	echo "$i,3,$(echo $sum_3/$ping_3 | bc -l)" >> $dest_1

	echo "Total Average latenct time for each user: $(echo $sum_1/$ping_1+$sum_2/$ping_2+$sum_3/$ping_3 | bc -l)" 
	echo "$i,$(echo $sum_1/$ping_1+$sum_2/$ping_2+$sum_3/$ping_3 | bc -l)" >> $dest_2
done

total_time="$(cat $dest_2 | gawk -F "," '{sum+=$2}; END {print sum}')"
echo $total_time
echo "$1,$(echo print $total_time/$1 | perl)" >> $dest_test


echo "1,$(echo $sum_url_1/$ping_url_1 | bc -l)" >> $dest_3
echo "2,$(echo $sum_url_2/$ping_url_2 | bc -l)" >> $dest_3
echo "3,$(echo $sum_url_3/$ping_url_3 | bc -l)" >> $dest_3

echo "$1,1,$(echo $sum_url_1/$ping_url_1 | bc -l)" >> $dest_test_2
echo "$1,2,$(echo $sum_url_2/$ping_url_2 | bc -l)" >> $dest_test_2
echo "$1,3,$(echo $sum_url_3/$ping_url_3 | bc -l)" >> $dest_test_2


echo "########################## GRAPHING ###############################"
Rscript --vanilla r_script.r $dest_1 "user_$1" "../../graphs/generated_graphs/per_user_per_page/"
