from selenium import webdriver
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import Select
import time


#Selenium code to create categories

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

# Go to the manage category page
edit_category_link = driver.find_element(By.CLASS_NAME, 'btn-primary[href="admin-category.php"]')
edit_category_link.click()

# Add supplier button
add_category_button = driver.find_element(By.XPATH, '/html/body/div/a')
add_category_button.click()

# Fill in information
name_input = driver.find_element(By.ID, 'name')
name_input.send_keys('Selenium')

# Submit  form
submit_button = driver.find_element(By.XPATH, '/html/body/form/section/div/div/div/div/div/button')
submit_button.click()

time.sleep(2)

# Close the browser
driver.quit()
