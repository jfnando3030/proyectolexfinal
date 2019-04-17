# -*- coding: utf-8 -*-
#!/usr/bin/python

from datetime import datetime, date, time, timedelta
import calendar
import os
import pymysql


fecha_actual = date.today()  # Asigna fecha actual
print(fecha_actual)

db = pymysql.connect("35.237.227.88","myuser","mypass","lex_backoffice")
cursor = db.cursor()



sql="SELECT * FROM lex_backoffice.pagos where activo=1 and estado=1"
cursor.execute(sql)
results = cursor.fetchall()
for row in results:
	date_end = row[4]
	user_id = row[1]
	print(date_end)
	if(fecha_actual>date_end):
		sql_update_query = """UPDATE lex_backoffice.pagos SET activo = 0, estado=0 WHERE fecha_finalizacion < %s"""
		input = (fecha_actual)
		cursor.execute(sql_update_query, input)
		db.commit()
		print("Tarifa actualizado correctamente")
		



db.close()