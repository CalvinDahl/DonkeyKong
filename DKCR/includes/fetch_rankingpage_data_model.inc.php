<?php
	function model_all_levels($pdo,$check_date,$start_date){
		$query = "SELECT player, nation, total_wr, total_duration, unique_wr, Z.Game_Percent as game_percent
		FROM(
			SELECT
			player,
			nation,
			COUNT(id) AS total_wr,
			SUM(difference) AS total_duration,
			COUNT(DISTINCT level_id) AS unique_wr
				FROM( 
					SELECT
					*,
					DATEDIFF(next_date,date_set) AS difference
					FROM( 
						SELECT
						*,
						COALESCE(
							(LEAD(date_set,1) OVER( 
								PARTITION BY level_id 
								ORDER BY date_set ASC, level_time DESC
							)
							),:check_date
						) AS next_date
						FROM upload WHERE date_set <= :check_date
					) AS X
				) AS Y
			WHERE difference >= 0
			GROUP BY player
		) AS t2
inner JOIN(
SELECT
	playerid,
	ROUND(100*(DATEDIFF(:check_date,:start_date) - SUM(holes))/DATEDIFF(:check_date,:start_date),2) AS Game_Percent
    FROM(
	SELECT
        e9.player as playerid,
        (DATEDIFF(:check_date,max(e9.Finish)) + DATEDIFF(min(e9.date_set),:start_date)) as holes
    FROM(
        SELECT
        *,
        COALESCE(
            (LEAD(date_set,1) OVER( 
                PARTITION BY level_id
                ORDER BY date_set ASC, level_time DESC
            )
            ),:check_date
        ) AS Finish
        FROM upload WHERE date_set <= :check_date
    ) AS e9 GROUP BY player
    UNION
    SELECT distinct
        e1.player,
        (DATEDIFF(e3.date_set, e1.Finish)) as holes
    FROM(
        SELECT
        *,
        COALESCE(
            (LEAD(date_set,1) OVER( 
                PARTITION BY level_id
                ORDER BY date_set ASC, level_time DESC
            )
            ),:check_date
        ) AS Finish
        FROM upload WHERE date_set <= :check_date
    ) AS e1
    join upload e3 on e1.Finish < e3.date_set
         and e3.player = e1.player
         and e3.date_set = (select min(date_set) FROM(
                                                    SELECT
                                                    *,
                                                    COALESCE(
                                                        (LEAD(date_set,1) OVER( 
                                                            PARTITION BY level_id
                                                            ORDER BY date_set ASC, level_time DESC
                                                        )
                                                        ),:check_date
                                                    ) AS Finish
                                                    FROM upload WHERE date_set <= :check_date
                                                ) AS e5
                         where e5.date_set > e1.Finish
                        and e5.player = e3.player)
    where not exists (select * FROM(
                                    SELECT
                                    *,
                                    COALESCE(
                                        (LEAD(date_set,1) OVER( 
                                            PARTITION BY level_id
                                            ORDER BY date_set ASC, level_time DESC
                                        )
                                        ),:check_date
                                    ) AS Finish
                                    FROM upload WHERE date_set <= :check_date
                                ) AS e7
                        where e7.date_set <= e1.Finish
                          and e7.Finish > e1.Finish
                          and e7.player = e1.player)
    order by playerid
    ) AS X GROUP BY playerid
)Z on(Z.playerid = t2.player)
    		ORDER BY total_wr DESC, total_duration DESC, unique_wr DESC";
		
		$stmt = $pdo->prepare($query);
		$stmt->bindParam(":check_date", $check_date);
		$stmt->bindParam(":start_date", $start_date);
		$stmt->execute();
		$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $results;
	}
	
	
	
	function model_levels($pdo,$check_date,$start_date,$level_id_page){
		$query = "SELECT player, nation, total_wr, total_duration, unique_wr, Z.Game_Percent as game_percent
		FROM(
			SELECT
			player,
			nation,
			COUNT(id) AS total_wr,
			SUM(difference) AS total_duration,
			COUNT(DISTINCT level_id) AS unique_wr
				FROM( 
					SELECT
					*,
					DATEDIFF(next_date,date_set) AS difference
					FROM( 
						SELECT
						*,
						COALESCE(
							(LEAD(date_set,1) OVER( 
								PARTITION BY level_id 
								ORDER BY date_set ASC, level_time DESC
							)
							),:check_date
						) AS next_date
						FROM upload WHERE level_id = :level_id_page AND date_set <= :check_date
					) AS X
				) AS Y
			WHERE difference >= 0
			GROUP BY player
		) AS t2
inner JOIN(
SELECT
	playerid,
	ROUND(100*(DATEDIFF(:check_date,:start_date) - SUM(holes))/DATEDIFF(:check_date,:start_date),2) AS Game_Percent
    FROM(
	SELECT
        e9.player as playerid,
        (DATEDIFF(:check_date,max(e9.Finish)) + DATEDIFF(min(e9.date_set),:start_date)) as holes
    FROM(
        SELECT
        *,
        COALESCE(
            (LEAD(date_set,1) OVER( 
                PARTITION BY level_id
                ORDER BY date_set ASC, level_time DESC
            )
            ),:check_date
        ) AS Finish
        FROM upload WHERE level_id = :level_id_page AND date_set <= :check_date
    ) AS e9 GROUP BY player
    UNION
    SELECT distinct
        e1.player,
        (DATEDIFF(e3.date_set, e1.Finish)) as holes
    FROM(
        SELECT
        *,
        COALESCE(
            (LEAD(date_set,1) OVER( 
                PARTITION BY level_id
                ORDER BY date_set ASC, level_time DESC
            )
            ),:check_date
        ) AS Finish
        FROM upload WHERE level_id = :level_id_page AND date_set <= :check_date
    ) AS e1
    join upload e3 on e1.Finish < e3.date_set
         and e3.player = e1.player
         and e3.date_set = (select min(date_set) FROM(
                                                    SELECT
                                                    *,
                                                    COALESCE(
                                                        (LEAD(date_set,1) OVER( 
                                                            PARTITION BY level_id
                                                            ORDER BY date_set ASC, level_time DESC
                                                        )
                                                        ),:check_date
                                                    ) AS Finish
                                                    FROM upload WHERE level_id = :level_id_page AND date_set <= :check_date
                                                ) AS e5
                         where e5.date_set > e1.Finish
                        and e5.player = e3.player)
    where not exists (select * FROM(
                                    SELECT
                                    *,
                                    COALESCE(
                                        (LEAD(date_set,1) OVER( 
                                            PARTITION BY level_id
                                            ORDER BY date_set ASC, level_time DESC
                                        )
                                        ),:check_date
                                    ) AS Finish
                                    FROM upload WHERE level_id = :level_id_page AND date_set <= :check_date
                                ) AS e7
                        where e7.date_set <= e1.Finish
                          and e7.Finish > e1.Finish
                          and e7.player = e1.player)
    order by playerid
    ) AS X GROUP BY playerid
)Z on(Z.playerid = t2.player)
    		ORDER BY total_wr DESC, total_duration DESC, unique_wr DESC";
		
		$stmt = $pdo->prepare($query);
		$stmt->bindParam(":check_date", $check_date);
		$stmt->bindParam(":start_date", $start_date);
		$stmt->bindParam(":level_id_page", $level_id_page);
		$stmt->execute();
		$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $results;
	}