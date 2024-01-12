from selenium import webdriver
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import Select
import time

# Login to account then log out of account


driver = webdriver.Chrome()
driver.maximize_window()

driver.get('http://localhost/logan/A2/A2(New)/app/index.php') 

# Go to login form
login_link = driver.find_element(By.CLASS_NAME, 'nav-link[href="./login.php"]')
login_link.click()


# Log in as admin
# Fill in login details
login_email_input = driver.find_element(By.ID, 'email')
login_email_input.send_keys('admin@admin.com') 

login_password_input = driver.find_element(By.ID, 'password')
login_password_input.send_keys('Password.11') 

# Submit the login form
login_button = driver.find_element(By.XPATH, '/html/body/form/section/div/div/div/div/div/button')
login_button.click()

time.sleep(2)


# Logout 
logout_button = driver.find_element(By.CLASS_NAME, 'nav-link[href="./logout.php"]')
logout_button.click()

time.sleep(2)