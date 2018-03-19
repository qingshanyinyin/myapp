<?php
class Db
{
    function __construct($sql)
    {
        $querystr = trim($sql);
        $querystr = substr($sql,0,6);        //如果是查询语句就连接从服务器
        if($querystr == 'select')
        {
            $conn = mysql_connect('192.168.1.105:3306','root','111111');
            mysql_select_db('test');
            mysql_query('set names utf8');

            $data = array();
            $res = mysql_query($sql);            while ($row = mysql_fetch_assoc($res)) {
            $data[] = $row;
        }

            print_r($data);
            echo '<br/>';
            echo mysql_get_host_info($conn).'||'.mysql_get_server_info($conn).'||'.mysql_get_proto_info($conn);
        }        //如果不是查询语句就连接主服务器
        else
        {
            $conn = mysql_connect('192.168.1.101:3306','root','111111');
            mysql_select_db('test');
            mysql_query('set names utf8');

            mysql_query($sql);
            echo mysql_affected_rows();
            echo '<br/>';
            echo mysql_get_host_info($conn).'||'.mysql_get_server_info($conn).'||'.mysql_get_proto_info($conn);
        }
    }
}

$sql1 = "select * from a";
$sql2 = "insert into a (name) values ('Alice')";
$sql3 = "delete from a where id=5";
$sql4 = "update a set name='Jerry' where id=4";//$model1 = new Db($sql1);//$model2 = new Db($sql2);//$model3 = new Db($sql3);$model4 = new Db($sql4);