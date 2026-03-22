pipeline {
    agent any

    stages {
        stage('Pull Code') {
            steps {
                git branch: 'nom_prenom_burger', url: 'https://github.com/TON_USERNAME/TON_REPO.git'
            }
        }

        stage('Install Dependencies') {
            steps {
                sh 'composer install'
            }
        }

        stage('Build Docker Image') {
            steps {
                sh 'docker build -t laravel-app .'
            }
        }
    }
}
