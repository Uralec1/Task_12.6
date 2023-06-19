<?php
$example_persons_array = [
    [
        'fullname' => 'Иванов Иван Иванович',
        'job' => 'tester',
    ],
    [
        'fullname' => 'Степанова Наталья Степановна',
        'job' => 'frontend-developer',
    ],
    [
        'fullname' => 'Пащенко Владимир Александрович',
        'job' => 'analyst',
    ],
    [
        'fullname' => 'Громов Александр Иванович',
        'job' => 'fullstack-developer',
    ],
    [
        'fullname' => 'Славин Семён Сергеевич',
        'job' => 'analyst',
    ],
    [
        'fullname' => 'Цой Владимир Антонович',
        'job' => 'frontend-developer',
    ],
    [
        'fullname' => 'Быстрая Юлия Сергеевна',
        'job' => 'PR-manager',
    ],
    [
        'fullname' => 'Шматко Антонина Сергеевна',
        'job' => 'HR-manager',
    ],
    [
        'fullname' => 'аль-Хорезми Мухаммад ибн-Муса',
        'job' => 'analyst',
    ],
    [
        'fullname' => 'Бардо Жаклин Фёдоровна',
        'job' => 'android-developer',
    ],
    [
        'fullname' => 'Шварцнегер Арнольд Густавович',
        'job' => 'babysitter',
    ],
];

//Функция для разбиения ФИО на части
function getPartsFromFullname ($fullName) {
    $person_name = ['surname', 'name', 'patronomyc'];
    return array_combine($person_name,explode(' ', $fullName));
}
echo 'Результат функции для разбиения ФИО на части:' . "<br>";
$arrParts = getPartsFromFullname($example_persons_array[6]['fullname']);
print_r($arrParts);
echo "<br>"."<br>";

//Функция для объединения ФИО из частей
function getFullnameFromParts ($surname, $name, $patronomyc) {
    return $surname .= ' ' . $name . ' ' . $patronomyc;
}
echo 'Результат функции для объединения ФИО из частей:' . "<br>";
$arrFullName = getFullnameFromParts($arrParts['surname'], $arrParts['name'], $arrParts['patronomyc']);
print_r($arrFullName);
echo "<br>"."<br>";

//Функция сокращения ФИО
function getShortName ($fullName) {
    $socrFIO = getPartsFromFullname ($fullName);
    return $socrFIO['name']. ' ' .mb_substr($socrFIO['surname'], 0, 1). '.';
}
echo 'Результат функции для сокращения ФИО:' . "<br>";
$arrSocr = getShortName($example_persons_array[6]['fullname']);
print_r($arrSocr);
echo "<br>"."<br>";

//Функция определения пола по ФИО
function getGenderFromName ($fullName) {
    $socrFIO = getPartsFromFullname ($fullName);
    $gender = 0;
    //Признаки женского пола:
    if (mb_substr($socrFIO['surname'], -2, 2) == 'ва') {
        --$gender;
    }
    if (mb_substr($socrFIO['name'], -1, 1) == 'а') {
        --$gender;
    }
    if (mb_substr($socrFIO['patronomyc'], -3, 3) == 'вна') {
        --$gender;
    }
    //Признаки мужского пола:
    if (mb_substr($socrFIO['surname'], -1, 1) == 'в') {
        ++$gender;
    }
    if (mb_substr($socrFIO['name'], -1, 1) == 'й' || (mb_substr($socrFIO['name'], -1, 1) == 'н')) {
        ++$gender;
    }
    if (mb_substr($socrFIO['patronomyc'], -2, 2) == 'ич') {
        ++$gender;
    } 
    switch($gender <=> 0){
        case 1:
            return 'Мужчина';
            break;
        case -1:
            return 'Женщина';
            break;
        default:
            return'Не удалось определить';
    }   
}
for ($i=0;$i<count($example_persons_array);$i++){
    // Определяется пол всех ФИО в массиве
$arrGender[$example_persons_array[$i]['fullname']] = getGenderFromName($example_persons_array[$i]['fullname']);
}
echo 'Результат функции определения пола по ФИО' . "<br>";
print_r($arrGender);
echo "<br>"."<br>";
?>