
def opciones(option, cursor):
    if option == 1:
        cursor.execute("""alter view tablilla as
                            select 
                            a.NOMBRE, 
                            b.year
                            from BDT2.dbo.PAISES_PARTICIPANTES as a, BDT2.dbo.resumen_FIFA as b
                            where b.CHAMPION = a.ID_PAIS""")
        cursor.commit()
        resultado = cargar_tabla(cursor)
        print("#########################################")
        for row in resultado:
            print("el Campeon en "+ str(row[1]) + " fue " + row[0])
        cursor.commit()
        print("#########################################")
    elif option == 2:
        for año in range(1930, 2023, 4):
            if año != 1942 and año != 1946:  
                cursor.execute(f"""alter view tablilla as SELECT TOP 5 a.Goals_For, b.NOMBRE 
                                From BDT2.dbo.FIFA_{año} AS a, BDT2.dbo.PAISES_PARTICIPANTES as b
                                where a.Team = b.ID_PAIS
                                ORDER BY Goals_For DESC
                            """)
                cursor.commit()
                resultado = cargar_tabla(cursor)
                print("#########################################")
                print(f"Año: {año}")
                print("Cant goles|Pais")
                for row in resultado:
                    print("La cantidad de goles fue " + str(row[0]) + " hechos por " + row[1])
                print("#########################################\n")
                cursor.commit()
    elif option == 3:
        cursor.execute("""alter view tablilla as SELECT TOP 5 b.NOMBRE , COUNT(THIRD_PLACE) as [CountTP] From BDT2.dbo.resumen_FIFA as a, BDT2.dbo.PAISES_PARTICIPANTES as b
                            where a.THIRD_PLACE = b.ID_PAIS
                            GROUP BY NOMBRE
                            HAVING COUNT(THIRD_PLACE) > 0
                            ORDER BY [CountTP] DESC
                        """)
        cursor.commit()
        resultado = cargar_tabla(cursor)
        print("#########################################")
        print("Top 5 con mayores tercer lugar son:\n")
        for row in resultado:
            print(row[0] +" con "+ str(row[1]) + " veces en esa posicion ")
        cursor.commit()
        print("#########################################")
    elif option == 4:
        for año in range(1930, 2023, 4):
            if año != 1942 and año != 1946:  
                cursor.execute(f"""alter view tablilla as SELECT top 1 b.NOMBRE, a.Goals_Against from BDT2.dbo.FIFA_{año} as a , BDT2.dbo.PAISES_PARTICIPANTES as b
                                    where a.Team = b.ID_PAIS
                                    order by a.Goals_Against desc;
                            """)
                cursor.commit()
                resultado = cargar_tabla(cursor)
                print("#########################################")
                print(f"En el Año {año} fue: ")
                for row in resultado:
                    print(row[0] + " con " + str(row[1]))
                print("#########################################\n")
                cursor.commit()
    elif option == 5:
        cursor.execute("""SELECT * from BDT2.dbo.PAISES_PARTICIPANTES""")
        resultado = cursor.fetchall()
        for row in resultado:
            print(row)
        cursor.commit()
        op_pais = int(input("Ingrese id del pais al cual usted quiere consultar: "))
        for año in range(1930, 2023, 4):
            if año != 1942 and año != 1946:  
                cursor.execute(f"""alter view tablilla2 as 
                                    SELECT a.[Position]
                                    ,a.[Games_Played]
                                    ,a.[Win]
                                    ,a.[Draw]
                                    ,a.[Loss]
                                    ,a.[Goals_For]
                                    ,a.[Goals_Against]
                                    ,a.[Goal_Difference]
                                    ,a.[Points]
                                FROM [BDT2].[dbo].[FIFA_{año}] as a, [BDT2].[dbo].[PAISES_PARTICIPANTES] as b
                                WHERE Team IN ('{op_pais}') AND a.team = b.id_pais;
                            """)
                cursor.commit()
                resultado = cursor.execute("select * from tablilla2")
                print("#########################################")
                print(f"En el Año: {año}")
                for row in resultado:
                    print("Posicion = " + str(row[0]) + " Cant partidos = " + str(row[1]) + " jugados = "+ str(row[2]) +" ganados = "+ str(row[3]) +" perdidos = "+ str(row[4]) +" goles a favor = "+ str(row[5]) +" goles en contra =" + str(row[6]) + " dif de goles =" + str(row[7]) +" puntos = "+ str(row[8]))
                print("#########################################\n")
                cursor.commit()
    elif option == 6:
        cursor.execute("""alter VIEW tablilla AS 
                        SELECT top 3 b.NOMBRE, COUNT(*) N_ganadas
                        FROM (
                        SELECT * from BDT2.dbo.FIFA_1930
                        UNION
                        SELECT * from BDT2.dbo.FIFA_1934
                        UNION
                        SELECT * from BDT2.dbo.FIFA_1938
                        UNION
                        SELECT * from BDT2.dbo.FIFA_1950
                        UNION
                        SELECT * from BDT2.dbo.FIFA_1954
                        UNION
                        SELECT * from BDT2.dbo.FIFA_1958
                        UNION
                        SELECT * from BDT2.dbo.FIFA_1962
                        UNION
                        SELECT * from BDT2.dbo.FIFA_1966
                        UNION
                        SELECT * from BDT2.dbo.FIFA_1970
                        UNION
                        SELECT * from BDT2.dbo.FIFA_1974
                        UNION
                        SELECT * from BDT2.dbo.FIFA_1978
                        UNION
                        SELECT * from BDT2.dbo.FIFA_1982
                        UNION
                        SELECT * from BDT2.dbo.FIFA_1986
                        UNION
                        SELECT * from BDT2.dbo.FIFA_1990
                        UNION
                        SELECT * from BDT2.dbo.FIFA_1994
                        UNION
                        SELECT * from BDT2.dbo.FIFA_1998
                        UNION
                        SELECT * from BDT2.dbo.FIFA_2002
                        UNION
                        SELECT * from BDT2.dbo.FIFA_2006
                        UNION
                        SELECT * from BDT2.dbo.FIFA_2010
                        UNION
                        SELECT * from BDT2.dbo.FIFA_2014
                        UNION
                        SELECT * from BDT2.dbo.FIFA_2018
                        UNION
                        SELECT * from BDT2.dbo.FIFA_2022
                        )as a, BDT2.dbo.PAISES_PARTICIPANTES as b
                        where a.team = b.id_pais
                        GROUP BY b.nombre ORDER BY COUNT(*) DESC ;
                        """)
        cursor.commit()
        resultado = cargar_tabla(cursor)
        print("#########################################\n TOP 3 estan")
        for row in resultado:
            print("Esta " + row[0] +" con " + str(row[1])+ " veces en el mundial")
        cursor.commit()
        print("#########################################")
    elif option == 7:
        cursor.execute("""alter view tablilla as SELECT top 1 b.NOMBRE,
                        sum(a.win) as 'Wins' 
                        FROM (
                        SELECT * from BDT2.dbo.FIFA_1930
                        UNION
                        SELECT * from BDT2.dbo.FIFA_1934
                        UNION
                        SELECT * from BDT2.dbo.FIFA_1938
                        UNION
                        SELECT * from BDT2.dbo.FIFA_1950
                        UNION
                        SELECT * from BDT2.dbo.FIFA_1954
                        UNION
                        SELECT * from BDT2.dbo.FIFA_1958
                        UNION
                        SELECT * from BDT2.dbo.FIFA_1962
                        UNION
                        SELECT * from BDT2.dbo.FIFA_1966
                        UNION
                        SELECT * from BDT2.dbo.FIFA_1970
                        UNION
                        SELECT * from BDT2.dbo.FIFA_1974
                        UNION
                        SELECT * from BDT2.dbo.FIFA_1978
                        UNION
                        SELECT * from BDT2.dbo.FIFA_1982
                        UNION
                        SELECT * from BDT2.dbo.FIFA_1986
                        UNION
                        SELECT * from BDT2.dbo.FIFA_1990
                        UNION
                        SELECT * from BDT2.dbo.FIFA_1994
                        UNION
                        SELECT * from BDT2.dbo.FIFA_1998
                        UNION
                        SELECT * from BDT2.dbo.FIFA_2002
                        UNION
                        SELECT * from BDT2.dbo.FIFA_2006
                        UNION
                        SELECT * from BDT2.dbo.FIFA_2010
                        UNION
                        SELECT * from BDT2.dbo.FIFA_2014
                        UNION
                        SELECT * from BDT2.dbo.FIFA_2018
                        UNION
                        SELECT * from BDT2.dbo.FIFA_2022
                        )as a, BDT2.dbo.PAISES_PARTICIPANTES as b
                        where a.team = b.id_pais
                        GROUP BY b.nombre ORDER BY SUM(a.win) DESC;
                        """)
        cursor.commit()
        resultado = cargar_tabla(cursor)
        print("#########################################")
        for row in resultado:
            print("Pais con mayor victorias en todo los tiempos es " + row[0] + " con " + str(row[1]))
        cursor.commit()
        print("#########################################")
    elif option == 8:
        cursor.execute("""alter view tablilla as 
                        select [year], 
                        case when [host] = [champion] then b.NOMBRE
                        END as HOSTEADOR
                        from BDT2.dbo.resumen_FIFA as a, BDT2.dbo.PAISES_PARTICIPANTES as b
                        where a.host = a.CHAMPION and a.CHAMPION = b.ID_PAIS
                        """)
        cursor.commit()
        resultado = cargar_tabla(cursor)
        print("#########################################")
        for row in resultado:
            print("En el anio: "+ str(row[0])+ " fue " + row[1])
        cursor.commit()
        print("#########################################")
    elif option == 9:
        cursor.execute("""alter view tablilla as SELECT b.NOMBRE,
                        count(a.THIRD_PLACE + a.RUNNER_UP + a.CHAMPION) as 'total podio' 
                        FROM BDT2.dbo.resumen_FIFA as a, BDT2.dbo.PAISES_PARTICIPANTES as b
                        where a.THIRD_PLACE = b.id_pais OR a.RUNNER_UP = b.id_pais OR a.champion = b.id_pais
                        GROUP BY b.nombre;
                        """)
        cursor.commit()
        cursor.execute("select top 1 * from tablilla order by 'total podio' desc")
        resultado = cursor.fetchall()
        print("#########################################")
        for row in resultado:
            print("Mayor cant de veces en los primeros 3 lugares fue " + row[0] + " con "+ str(row[1]))
        cursor.commit()
        print("#########################################")
    else:
        cursor.execute("""
            alter view tablilla3 as SELECT TOP 2
                P1.NOMBRE AS Pais1,
                P2.NOMBRE AS Pais2,
                COUNT(*) AS Cantidad_Enfrentamientos
            FROM
                resumen_FIFA AS R
            INNER JOIN
                PAISES_PARTICIPANTES AS P1 ON R.CHAMPION = P1.ID_PAIS
            INNER JOIN
                PAISES_PARTICIPANTES AS P2 ON R.RUNNER_UP = P2.ID_PAIS
            WHERE
                P1.NOMBRE != P2.NOMBRE  -- Para evitar contar enfrentamientos de un país consigo mismo
            GROUP BY
                P1.NOMBRE, P2.NOMBRE
            HAVING
                COUNT(*) > 0
            ORDER BY
                Cantidad_Enfrentamientos DESC
            """)
        cursor.commit()
        resultado = cursor.execute("select * from tablilla3")
        for row in resultado:   
            print(f'{row.Pais1} vs {row.Pais2}: {row.Cantidad_Enfrentamientos} veces')
        cursor.commit()   
    return None
def menuprincipal(cursor):
    flag = True
    print("Bienvenido a Fut-Usm")
    print("Cual es la informacion que te apetece buscar:")
    print("1. Mostrar Campeones")
    print("2. Mostrar goleadores")
    print("3. Mostrar Tercer Lugar m´as veces")
    print("4. Mostrar Pa´ıs m´as goles recibidos")
    print("5. Buscar un pa´ıs")
    print("6. Top 3 pa´ıses en el mundial")
    print("7. Mayor cantidad ganados")
    print("8. Pa´ıses ganando en casa")
    print("9. M´as veces en el podio")
    print("10. Mayores rivales")
    print("0. Salir")
    while(flag):
        option = input("Ingrese su opcion: ")
        try:
            option = int(option)
        except ValueError as ex:
            print('Commando ingresado no reconocido, ingrese de nuevo ', ex)
        if int(option) == 0:
            flag = False
        elif (int(option)) > 10 or (int(option)) < 0:
            print('Commando ingresado no reconocido, ingrese de nuevo')
        else:
            opciones(int(option), cursor)
    return 0
def cargar_tabla(cursor):
    cursor.execute("select * from BDT2.dbo.tablilla")
    return cursor.fetchall()
def crear_tabla1(cursor):
    cursor.execute("""create view tablilla as select 
	                        a.NOMBRE, 
	                        b.year
                        from BDT2.dbo.PAISES_PARTICIPANTES as a, BDT2.dbo.resumen_FIFA as b
                        where b.CHAMPION = a.ID_PAIS
                        """)
    cursor.commit()
    return None
def crear_tabla2(cursor):
    cursor.execute("""create view tablilla2 as 
                    SELECT a.[Position]
                    ,a.[Games_Played]
                    ,a.[Win]
                    ,a.[Draw]
                    ,a.[Loss]
                    ,a.[Goals_For]
                    ,a.[Goals_Against]
                    ,a.[Goal_Difference]
                    ,a.[Points]
                    FROM [BDT2].[dbo].[FIFA_1930] as a
                    """)
    cursor.commit()
    return None
def crear_tabla3(cursor):
    cursor.execute("""create view tablilla3 as select 
	                        a.NOMBRE, 
	                        b.year,
                            b.champion
                        from BDT2.dbo.PAISES_PARTICIPANTES as a, BDT2.dbo.resumen_FIFA as b
                        where b.CHAMPION = a.ID_PAIS
                        """)
    cursor.commit()
    return None
 