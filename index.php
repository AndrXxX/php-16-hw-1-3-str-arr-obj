<?php
    $homeWorkNum = '1.3';
    $homeWorkCaption = 'Строки, массивы и объекты';

    /* Задаем массив животных (п.1 задания)*/
    $arrAnimals = array(
        'Africa' => array('Daubentonia', 'Addax nasomaculatus', 'Papio cynocephalus'),
        'Australia' => array('Tachyglossus aculeatus', 'Wallabia bicolor', 'Casuarius casuarius'),
        'North America' => array('Ursus americanus', 'Cervus elaphus subspp'),
        'Eurasia' => array('Macaca silenus', 'Gavialis gangeticus', 'Bos frontalis', 'Castor fiber'),
        'South America' => array('Lepus timidus', 'Sus scrofa', 'Myocastor coypus'),
    );

    /* Создаем многомерный массив, содержащий первую и вторую части названия животных, у которых оно состоит из двух слов*/
    $animalsSeparatedNames = array(
        '0' => array(),
        '1' => array(),
    );
    foreach ($arrAnimals as $continent => $animals) {
        foreach ($animals as $animal) {
            $tempAnimalsArray = explode(' ', $animal);
            if (count($tempAnimalsArray) == 2) {
                $animalsSeparatedNames[0][] = $tempAnimalsArray[0];
                $animalsSeparatedNames[1][] = $tempAnimalsArray[1];
            }
        }
    }

    /*Перемешиваем элементы многомерного массива*/
    shuffle($animalsSeparatedNames[0]);
    shuffle($animalsSeparatedNames[1]);

    /*Создаем новый массив с животными и континентами*/
    $newArrAnimals = array();
    for ($i = 0; $i < count($animalsSeparatedNames[0]); $i++) {
        $newArrAnimals[searchContinent($animalsSeparatedNames[0][$i], $arrAnimals)][] = $animalsSeparatedNames[0][$i] . ' ' . $animalsSeparatedNames[1][$i];
    }

    /*Выводим массив на экран в нужном виде - континет в виде заголовка h2, животные - одной строкой через запятую.*/
    foreach ($newArrAnimals as $continent => $animals) {
        echo '<h2>' . $continent . '</h2>';
        echo '<p>' . implode(', ', $animals) . '</p>';
        echo '<br>';
    }

    /*Функция позволяет найти название континета, в котором обитает животное по первому слову названия животного*/
    function searchContinent($animalName, $arrAnimals)
    {
        if (!is_null($animalName) and !is_null($arrAnimals)) {
            foreach ($arrAnimals as $continent => $animals) {
                if (is_array($animals)) {
                    foreach ($animals as $animal) {
                        if (is_numeric(array_search($animalName, explode(' ', $animal)))) {
                            return $continent;
                        }
                    }
                }
            }
        } else {
            return null;
        }
    }
