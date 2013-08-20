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

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_questions_by_tag`(IN `Tag` VARCHAR(50))
    READS SQL DATA
    SQL SECURITY INVOKER
select m.MetaValue, q.ID as QuestionID, q.Question, q.Level, q.ActiveStatus 
from questions as q inner join meta_data as m on q.ID = m.QuestionId 
where m.MetaKey = 'tag' and m.MetaValue = Tag
order by QuestionID;

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_questions_in_quiz`(IN `QuizId` INT)
    READS SQL DATA
    SQL SECURITY INVOKER
SELECT  qs.ID, qs.Question, qs.Level, qs.ActiveStatus
FROM    questions qs
        INNER JOIN quiz qz
            ON FIND_IN_SET(qs.ID, qz.QuestionIds) > 0
WHERE   qz.QuizId = QuizId;

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_question_status`(IN `Quiz_Id` INT, IN `Status` VARCHAR(1))
    MODIFIES SQL DATA
    SQL SECURITY INVOKER
UPDATE questions SET ActiveStatus = Status 
WHERE FIND_IN_SET(ID, (SELECT QuestionIds from quiz where QuizId = Quiz_Id)) > 0;

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_quiz_status`(IN `Quiz_Id` INT, IN `Status` VARCHAR(1))
    MODIFIES SQL DATA
    SQL SECURITY INVOKER
begin
UPDATE quiz set ActiveStatus = Status where QuizId = Quiz_Id;
call update_question_status (Quiz_Id,Status);
end;

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_ungrouped_questions_by_tag`(IN `Tag` VARCHAR(20))
    READS SQL DATA
    SQL SECURITY INVOKER
SELECT meta.MetaValue, qs.Level, qs.ID, qs.Question, qs.ActiveStatus
FROM questions qs
LEFT OUTER JOIN quiz qz ON FIND_IN_SET(qs.ID, qz.QuestionIds) > 0
inner join meta_data as meta on meta.QuestionId = qs.ID and meta.MetaKey = 'tag' and meta.MetaValue = Tag
where qz.QuizId is null
order by qz.QuizId, meta.MetaValue, qs.Level, qs.ID;

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_all_ungrouped_questions`()
    READS SQL DATA
    SQL SECURITY INVOKER
SELECT meta.MetaValue, qs.Level, qs.ID, qs.Question, qs.ActiveStatus
FROM questions qs
LEFT OUTER JOIN quiz qz ON FIND_IN_SET(qs.ID, qz.QuestionIds) > 0
inner join meta_data as meta on meta.QuestionId = qs.ID and meta.MetaKey = 'tag'
where qz.QuizId is null
order by meta.MetaValue, qs.Level, qs.ID;
