from selenium import webdriver
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import Select
import time


# Launch Chrome
driver = webdriver.Chrome()
driver.maximize_window()

driver.get('http://localhost/logan/A2/A2(New)/app/index.php') 

# Click the register here button
register_link = driver.find_element(By.XPATH, '/html/body/div[2]/div/div[2]/div/div/a')
register_link.click()

time.sleep(3)

# Go back to the index page
index_link = driver.find_element(By.CLASS_NAME, 'nav-link[href="./index.php"]')
index_link.click()

time.sleep(2)

# Get started button
login_link = driver.find_element(By.XPATH, '/html/body/div[1]/a')
login_link.click()

time.sleep(2)

# Go back to the index page
home_link = driver.find_element(By.CLASS_NAME, 'nav-link[href="./index.php"]')
home_link.click()

time.sleep(2)

products_link = driver.find_element(By.XPATH, '/html/body/div[2]/div/div[1]/div/div/a')
products_link.click()

time.sleep(2)

# Close the browser
driver.quit()
