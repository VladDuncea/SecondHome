from selenium import webdriver
import time
from selenium.webdriver.common.keys import Keys
import unittest
from selenium import webdriver
import os


# teste login
class TestClassLoginCorect(unittest.TestCase):

    @classmethod
    def setUp(self):
        self.driver = webdriver.Firefox(executable_path=r'D:\Facultate\sem2\MDS\teste\driver\geckodriver.exe')
        self.driver.implicitly_wait(20)
        self.driver.set_page_load_timeout(20)
        self.driver.maximize_window()

    # date corecte
    def test_Login_Date_Valide(self):
        self.driver.get("https://www.secondhome.fragmentedpixel.com/login.php")
        self.driver.find_element_by_name('email').send_keys('bianca.pascu@myboss')
        self.driver.find_element_by_name('password').send_keys('cisco123456')
        self.driver.find_element_by_name('conectare').click()
        assert 'index.php' in self.driver.current_url
        assert "No results found." not in self.driver.page_source

    # parola gresita
    def test_Login_Parola_Gresita(self):
        self.driver.get("https://www.secondhome.fragmentedpixel.com/login.php")
        self.driver.find_element_by_name('email').send_keys('bianca.pascu@myboss')
        self.driver.find_element_by_name('password').send_keys('cisco12345')
        self.driver.find_element_by_name('conectare').click()
        element = self.driver.find_element_by_xpath('.//div[@class = "callout callout-danger"]')
        assert "Combinatia User/Parola nu este corecta" == element.text
        assert 'login.php' in self.driver.current_url
        assert "No results found." not in self.driver.page_source

    # mail gresit
    def test_Login_Mail_Gresit(self):
        self.driver.get("https://www.secondhome.fragmentedpixel.com/login.php")
        self.driver.find_element_by_name('email').send_keys('bianca.pascu@my')
        self.driver.find_element_by_name('password').send_keys('cisco123456')
        self.driver.find_element_by_name('conectare').click()
        element = self.driver.find_element_by_xpath('.//div[@class = "callout callout-danger"]')
        assert "Combinatia User/Parola nu este corecta" == element.text
        assert 'login.php' in self.driver.current_url
        assert "No results found." not in self.driver.page_source

    # mail si parola gresite
    def test_Login_Date_Invalide(self):
        self.driver.get("https://www.secondhome.fragmentedpixel.com/login.php")
        self.driver.find_element_by_name('email').send_keys('bianca.pascu@my')
        self.driver.find_element_by_name('password').send_keys('cisco12345')
        self.driver.find_element_by_name('conectare').click()
        element = self.driver.find_element_by_xpath('.//div[@class = "callout callout-danger"]')
        assert "Combinatia User/Parola nu este corecta" == element.text
        assert 'login.php' in self.driver.current_url
        assert "No results found." not in self.driver.page_source

    @classmethod
    def tearDown(self):
        self.driver.quit()


# teste register
class TestClassRegisterCorect(unittest.TestCase):

    @classmethod
    def setUp(self):
        self.driver = webdriver.Firefox(executable_path=r'D:\Facultate\sem2\MDS\teste\driver\geckodriver.exe')
        self.driver.implicitly_wait(20)
        self.driver.set_page_load_timeout(20)
        self.driver.maximize_window()

    # mail care este deja in uz
    def test_Register_Mail_Utilizat(self):
        self.driver.get("https://www.secondhome.fragmentedpixel.com/register.php")
        self.driver.find_element_by_name('first_name').send_keys('Test')
        self.driver.find_element_by_name('last_name').send_keys('Automat')
        self.driver.find_element_by_name('email').send_keys('test.automat@testtest')
        self.driver.find_element_by_name('password').send_keys('test12345')
        self.driver.find_element_by_name('password_again').send_keys('test12345')
        self.driver.find_element_by_xpath('.//label[@class="custom-control-label"]').click()
        self.driver.find_element_by_xpath('.//button[@class="btn btn-primary btn-block"]').click()
        element = self.driver.find_element_by_xpath('.//span[@class = "error invalid-feedback"]')
        assert 'Acest email este deja asociat unui cont!' in element.text
        assert "No results found." not in self.driver.page_source

    # date corecte
    def test_Register_Date_Valide(self):
        self.driver.get("https://www.secondhome.fragmentedpixel.com/register.php")
        self.driver.find_element_by_name('first_name').send_keys('Test')
        self.driver.find_element_by_name('last_name').send_keys('Automat')
        self.driver.find_element_by_name('email').send_keys('test.automat@testtest12345')
        self.driver.find_element_by_name('password').send_keys('test12345')
        self.driver.find_element_by_name('password_again').send_keys('test12345')
        self.driver.find_element_by_xpath('.//label[@class="custom-control-label"]').click()
        self.driver.find_element_by_xpath('.//button[@class="btn btn-primary btn-block"]').click()
        element = self.driver.find_element_by_xpath('.//div[@class = "callout callout-success"]')
        assert 'Contul a fost creat cu succes' in element.text
        assert "No results found." not in self.driver.page_source

    # parola care nu respecta nr de caractere
    def test_Register_Parola_Neadecvata(self):
        self.driver.get("https://www.secondhome.fragmentedpixel.com/register.php")
        self.driver.find_element_by_name('first_name').send_keys('Test')
        self.driver.find_element_by_name('last_name').send_keys('Automat')
        self.driver.find_element_by_name('email').send_keys('test.automat@t')
        self.driver.find_element_by_name('password').send_keys('test')
        self.driver.find_element_by_name('password_again').send_keys('test')
        self.driver.find_element_by_xpath('.//label[@class="custom-control-label"]').click()
        self.driver.find_element_by_xpath('.//button[@class="btn btn-primary btn-block"]').click()
        element = self.driver.find_element_by_xpath('.//span[@id = "pass1-error"]')
        assert 'Your password must be at least 6 characters long' in element.text
        assert "No results found." not in self.driver.page_source

    @classmethod
    def tearDown(self):
        self.driver.quit()


# teste formular

class TestClassAdaugareAnimalCorect(unittest.TestCase):

    @classmethod
    def setUp(self):
        self.driver = webdriver.Firefox(executable_path=r'D:\Facultate\sem2\MDS\teste\driver\geckodriver.exe')
        self.driver.implicitly_wait(20)
        self.driver.set_page_load_timeout(20)
        self.driver.maximize_window()
        self.driver.get("https://www.secondhome.fragmentedpixel.com/login.php")
        self.driver.find_element_by_name('email').send_keys('bianca.pascu@myboss')
        self.driver.find_element_by_name('password').send_keys('cisco123456')
        self.driver.find_element_by_name('conectare').click()

    # date corecte
    def test_Formular_Add_Date_Valide(self):
        self.driver.get('https://www.secondhome.fragmentedpixel.com/formular_add.php')
        self.driver.find_element_by_name('animal_name').send_keys('Lola')
        self.driver.find_element_by_name('animal_type').send_keys('Pisici')
        self.driver.find_element_by_name('animal_age').send_keys('2')
        self.driver.find_element_by_name('animal_breed').send_keys('Gri')
        self.driver.find_element_by_name('animal_description').send_keys('Se joaca si prinde soareci.')
        self.driver.find_element_by_xpath('.//input[@id = "getFile"]').send_keys(os.getcwd() + '\pis1.jpg')
        self.driver.find_element_by_xpath('.//button[@class="btn btn-success float-right"]').click()
        element = self.driver.find_element_by_xpath('.//div[@class="toast-body"]')
        assert "Animalul dvs a fost adaugat cu succes, il puteti vedea si edita in pagina Animalele mele." in element.text
        assert "No results found." not in self.driver.page_source

    @classmethod
    def tearDown(self):
        self.driver.quit()


# teste editare
class TestClassEditareAnimalCorect(unittest.TestCase):

    @classmethod
    def setUp(self):
        self.driver = webdriver.Firefox(executable_path=r'D:\Facultate\sem2\MDS\teste\driver\geckodriver.exe')
        self.driver.implicitly_wait(20)
        self.driver.set_page_load_timeout(20)
        self.driver.maximize_window()
        self.driver.get("https://www.secondhome.fragmentedpixel.com/login.php")
        self.driver.find_element_by_name('email').send_keys('bianca.pascu@myboss')
        self.driver.find_element_by_name('password').send_keys('cisco123456')
        self.driver.find_element_by_name('conectare').click()

    # date corecte
    def test_Editare_cu_Poza_Date_Valide(self):
        self.driver.get('https://www.secondhome.fragmentedpixel.com/edit_animal.php?PID=632')
        self.driver.find_element_by_name('animal_name').clear()
        self.driver.find_element_by_name('animal_name').send_keys('Loli')
        self.driver.find_element_by_name('animal_age').clear()
        self.driver.find_element_by_name('animal_age').send_keys('12')
        self.driver.find_element_by_name('animal_breed').clear()
        self.driver.find_element_by_name('animal_breed').send_keys('Gri')
        self.driver.find_element_by_name('animal_description').clear()
        self.driver.find_element_by_name('animal_description').send_keys('Se joaca si prinde soareci.')
        self.driver.find_element_by_xpath('.//input[@id = "getFile"]').send_keys(os.getcwd() + '\pis1.jpg')
        self.driver.find_element_by_xpath('.//button[@class="btn btn-success float-right"]').click()
        element = self.driver.find_element_by_xpath('.//div[@class="toast-body"]')
        assert "Animalul dvs a fost editat cu succes, veti fi redirectionat in curand catre pagina acestuia." in element.text
        assert "No results found." not in self.driver.page_source

    # fara poza
    def test_Editare_fara_Poza_Date_Valide(self):
        self.driver.get('https://www.secondhome.fragmentedpixel.com/edit_animal.php?PID=632')
        self.driver.find_element_by_name('animal_name').clear()
        self.driver.find_element_by_name('animal_name').send_keys('Loli')
        self.driver.find_element_by_name('animal_age').clear()
        self.driver.find_element_by_name('animal_age').send_keys('22')
        self.driver.find_element_by_name('animal_breed').clear()
        self.driver.find_element_by_name('animal_breed').send_keys('Gri')
        self.driver.find_element_by_name('animal_description').clear()
        self.driver.find_element_by_name('animal_description').send_keys('Se joaca si prinde soareci.')
        self.driver.find_element_by_xpath('.//button[@class="btn btn-success float-right"]').click()
        element = self.driver.find_element_by_xpath('.//div[@class="toast-body"]')
        assert "Animalul dvs a fost editat cu succes, veti fi redirectionat in curand catre pagina acestuia." in element.text
        # assert 'detalii_animal.php' in self.driver.current_url
        assert "No results found." not in self.driver.page_source

    @classmethod
    def tearDown(self):
        self.driver.quit()


if __name__ == '__main__':
    unittest.main()
