pipeline {
    agent any

    stages {

        stage('Checkout Code') {
            steps {
                git branch: 'Thiam_Famata_burger',
                    url: 'https://github.com/FamataThiam/examen_ISI_Burger.git'
            }
        }

        stage('Build Docker Image') {
            steps {
                bat 'docker build -t laravel-app .'
            }
        }

    }
}
