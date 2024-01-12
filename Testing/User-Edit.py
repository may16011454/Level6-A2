from selenium import webdriver
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import Select
import time


#Selenium code to edit a user 

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

# Go to the manage user page
edit_user_link = driver.find_element(By.XPATH, '/html/body/div/div/div[1]/div/div[2]/a')
edit_user_link.click()

# Edit top user button
edit_user_button = driver.find_element(By.XPATH, '/html/body/div/table/tbody/tr[1]/td[5]/a[1]')
edit_user_button.click()

# Fill in information
firstname_input = driver.find_element(By.ID, 'firstname')
# Clear the text in the input field
firstname_input.clear()
firstname_input.send_keys('Jack')

lastname_input = driver.find_element(By.ID, 'lastname')
lastname_input.clear()
lastname_input.send_keys('Test Works')

email_input = driver.find_element(By.ID, 'email')
email_input.clear()
email_input.send_keys('jack@milo.com')

# Select role from the dropdown
role_dropdown = Select(driver.find_element(By.ID, 'role'))
role_dropdown.select_by_value('1') 

# Submit  form
submit_button = driver.find_element(By.XPATH, '/html/body/div/form/button')
submit_button.click()

time.sleep(2)

# Close the browser
driver.quit()
