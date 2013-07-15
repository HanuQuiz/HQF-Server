CREATE DEFINER=`root`@`localhost` PROCEDURE `count_questions_by_tag`(IN `ActiveStatus` CHAR(1))
    READS SQL DATA
    SQL SECURITY INVOKER
select m.MetaValue as Tag, q.Level as Level, count(*) as Count 
from questions as q inner join meta_data as m on q.ID = m.QuestionId 
where m.MetaKey = 'tag' and q.ActiveStatus = ActiveStatus
group by tag, Level 
order by tag, Level;


CREATE DEFINER=`root`@`localhost` PROCEDURE `get_questions_by_tag_level_status`(IN `Tag` VARCHAR(20), IN `Level` TINYINT, IN `ActiveStatus` CHAR)
    READS SQL DATA
select m.MetaValue, q.ID as QuestionID, q.ActiveStatus 
from questions as q inner join meta_data as m on q.ID = m.QuestionId 
where m.MetaKey = 'tag' and m.MetaValue = Tag
and q.Level = Level and q.ActiveStatus = ActiveStatus
order by QuestionID;
