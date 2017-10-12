#!/usr/bin/env bash
## *************************************************************************
#   Re-install.
#
#       This is friendly user script, not user friendly
#       There are no protection from mistakes.
#       Use it if you know how it works.
## *************************************************************************

# current directory where from script was launched (to return to in the end)
DIR_CUR="$PWD"
# Root directory (relative to the current shell script, not to the execution point)
# http://pubs.opengroup.org/onlinepubs/9699919799/utilities/V3_chap02.html#tag_18_06_02
DIR_ROOT=${DIR_ROOT:=`cd "$( dirname "$0" )/../" && pwd`}



echo ""
echo "************************************************************************"
echo "  Remove 'vendor' folder & 'composer.lock' file then reinstall app."
echo "************************************************************************"
rm -fr ${DIR_ROOT}/vendor
rm -fr ${DIR_ROOT}/composer.lock
composer install



echo ""
echo "************************************************************************"
echo "  Re-generate code coverage report."
echo "************************************************************************"
rm -fr ${DIR_ROOT}/test/coverage
php ${DIR_ROOT}/vendor/bin/phpunit -c ${DIR_ROOT}/test/unit/phpunit.dist.xml



echo ""
echo "************************************************************************"
echo "  The job is done."
echo "************************************************************************"

cd ${DIR_CUR}