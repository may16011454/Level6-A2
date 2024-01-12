from selenium import webdriver
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import Select
import time

# Selenium code to edit a category

# Launch Chrome
driver = webdriver.Chrome()
driver.maximize_window()

# Open the website
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

# Go to the manage inventory page
edit_category_link = driver.find_element(By.CLASS_NAME, 'btn-primary[href="admin-equipments.php"]')
edit_category_link.click()

# Edit top user button
edit_category_button = driver.find_element(By.XPATH, '/html/body/div/table/tbody/tr[1]/td[6]/a[1]')
edit_category_button.click()

# Fill in information
name_input = driver.find_element(By.ID, 'name')
name_input.clear()
name_input.send_keys('bnarnar')

description_input = driver.find_element(By.ID, 'description')
description_input.clear()
description_input.send_keys('banana edit test')

image_input = driver.find_element(By.ID, 'image')
image_input.clear()
image_input.send_keys('https://64.media.tumblr.com/13d314d37f96ed90fdd9d8e8098c32b5/e3d87464fd25a7c5-62/s640x960/60961948771848a80bef939442a786bbb4575a6b.jpg')

# Select role from the dropdown
supplier_dropdown = Select(driver.find_element(By.ID, 'supplier'))
supplier_dropdown.select_by_value('5')

category_dropdown = Select(driver.find_element(By.ID, 'category'))
category_dropdown.select_by_value('1')

# Submit form
submit_button = driver.find_element(By.XPATH, '/html/body/div/form/button')
submit_button.click()

time.sleep(2)

# Close the browser
driver.quit()
