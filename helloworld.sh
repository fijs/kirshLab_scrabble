for file in `ls`
do
	month=`ls -lt $file|cut -d' ' -f6`
	day=`ls -lt $file|cut -d' ' -f7`
	if [[ $month = "Apr" ]] && [[ $day = "23"  ]]
	then
		echo "$file will be deleted!"
		rm $file
	fi
done
