<?php

// This file was auto-generated from sdk-root/src/data/codebuild/2016-10-06/api-2.json
return ['version' => '2.0', 'metadata' => ['apiVersion' => '2016-10-06', 'endpointPrefix' => 'codebuild', 'jsonVersion' => '1.1', 'protocol' => 'json', 'serviceFullName' => 'AWS CodeBuild', 'signatureVersion' => 'v4', 'targetPrefix' => 'CodeBuild_20161006', 'uid' => 'codebuild-2016-10-06'], 'operations' => ['BatchDeleteBuilds' => ['name' => 'BatchDeleteBuilds', 'http' => ['method' => 'POST', 'requestUri' => '/'], 'input' => ['shape' => 'BatchDeleteBuildsInput'], 'output' => ['shape' => 'BatchDeleteBuildsOutput'], 'errors' => [['shape' => 'InvalidInputException']]], 'BatchGetBuilds' => ['name' => 'BatchGetBuilds', 'http' => ['method' => 'POST', 'requestUri' => '/'], 'input' => ['shape' => 'BatchGetBuildsInput'], 'output' => ['shape' => 'BatchGetBuildsOutput'], 'errors' => [['shape' => 'InvalidInputException']]], 'BatchGetProjects' => ['name' => 'BatchGetProjects', 'http' => ['method' => 'POST', 'requestUri' => '/'], 'input' => ['shape' => 'BatchGetProjectsInput'], 'output' => ['shape' => 'BatchGetProjectsOutput'], 'errors' => [['shape' => 'InvalidInputException']]], 'CreateProject' => ['name' => 'CreateProject', 'http' => ['method' => 'POST', 'requestUri' => '/'], 'input' => ['shape' => 'CreateProjectInput'], 'output' => ['shape' => 'CreateProjectOutput'], 'errors' => [['shape' => 'InvalidInputException'], ['shape' => 'ResourceAlreadyExistsException'], ['shape' => 'AccountLimitExceededException']]], 'CreateWebhook' => ['name' => 'CreateWebhook', 'http' => ['method' => 'POST', 'requestUri' => '/'], 'input' => ['shape' => 'CreateWebhookInput'], 'output' => ['shape' => 'CreateWebhookOutput'], 'errors' => [['shape' => 'InvalidInputException'], ['shape' => 'OAuthProviderException'], ['shape' => 'ResourceAlreadyExistsException'], ['shape' => 'ResourceNotFoundException']]], 'DeleteProject' => ['name' => 'DeleteProject', 'http' => ['method' => 'POST', 'requestUri' => '/'], 'input' => ['shape' => 'DeleteProjectInput'], 'output' => ['shape' => 'DeleteProjectOutput'], 'errors' => [['shape' => 'InvalidInputException']]], 'DeleteWebhook' => ['name' => 'DeleteWebhook', 'http' => ['method' => 'POST', 'requestUri' => '/'], 'input' => ['shape' => 'DeleteWebhookInput'], 'output' => ['shape' => 'DeleteWebhookOutput'], 'errors' => [['shape' => 'InvalidInputException'], ['shape' => 'ResourceNotFoundException'], ['shape' => 'OAuthProviderException']]], 'InvalidateProjectCache' => ['name' => 'InvalidateProjectCache', 'http' => ['method' => 'POST', 'requestUri' => '/'], 'input' => ['shape' => 'InvalidateProjectCacheInput'], 'output' => ['shape' => 'InvalidateProjectCacheOutput'], 'errors' => [['shape' => 'InvalidInputException'], ['shape' => 'ResourceNotFoundException']]], 'ListBuilds' => ['name' => 'ListBuilds', 'http' => ['method' => 'POST', 'requestUri' => '/'], 'input' => ['shape' => 'ListBuildsInput'], 'output' => ['shape' => 'ListBuildsOutput'], 'errors' => [['shape' => 'InvalidInputException']]], 'ListBuildsForProject' => ['name' => 'ListBuildsForProject', 'http' => ['method' => 'POST', 'requestUri' => '/'], 'input' => ['shape' => 'ListBuildsForProjectInput'], 'output' => ['shape' => 'ListBuildsForProjectOutput'], 'errors' => [['shape' => 'InvalidInputException'], ['shape' => 'ResourceNotFoundException']]], 'ListCuratedEnvironmentImages' => ['name' => 'ListCuratedEnvironmentImages', 'http' => ['method' => 'POST', 'requestUri' => '/'], 'input' => ['shape' => 'ListCuratedEnvironmentImagesInput'], 'output' => ['shape' => 'ListCuratedEnvironmentImagesOutput']], 'ListProjects' => ['name' => 'ListProjects', 'http' => ['method' => 'POST', 'requestUri' => '/'], 'input' => ['shape' => 'ListProjectsInput'], 'output' => ['shape' => 'ListProjectsOutput'], 'errors' => [['shape' => 'InvalidInputException']]], 'StartBuild' => ['name' => 'StartBuild', 'http' => ['method' => 'POST', 'requestUri' => '/'], 'input' => ['shape' => 'StartBuildInput'], 'output' => ['shape' => 'StartBuildOutput'], 'errors' => [['shape' => 'InvalidInputException'], ['shape' => 'ResourceNotFoundException'], ['shape' => 'AccountLimitExceededException']]], 'StopBuild' => ['name' => 'StopBuild', 'http' => ['method' => 'POST', 'requestUri' => '/'], 'input' => ['shape' => 'StopBuildInput'], 'output' => ['shape' => 'StopBuildOutput'], 'errors' => [['shape' => 'InvalidInputException'], ['shape' => 'ResourceNotFoundException']]], 'UpdateProject' => ['name' => 'UpdateProject', 'http' => ['method' => 'POST', 'requestUri' => '/'], 'input' => ['shape' => 'UpdateProjectInput'], 'output' => ['shape' => 'UpdateProjectOutput'], 'errors' => [['shape' => 'InvalidInputException'], ['shape' => 'ResourceNotFoundException']]], 'UpdateWebhook' => ['name' => 'UpdateWebhook', 'http' => ['method' => 'POST', 'requestUri' => '/'], 'input' => ['shape' => 'UpdateWebhookInput'], 'output' => ['shape' => 'UpdateWebhookOutput'], 'errors' => [['shape' => 'InvalidInputException'], ['shape' => 'ResourceNotFoundException'], ['shape' => 'OAuthProviderException']]]], 'shapes' => ['AccountLimitExceededException' => ['type' => 'structure', 'members' => [], 'exception' => \true], 'ArtifactNamespace' => ['type' => 'string', 'enum' => ['NONE', 'BUILD_ID']], 'ArtifactPackaging' => ['type' => 'string', 'enum' => ['NONE', 'ZIP']], 'ArtifactsType' => ['type' => 'string', 'enum' => ['CODEPIPELINE', 'S3', 'NO_ARTIFACTS']], 'BatchDeleteBuildsInput' => ['type' => 'structure', 'required' => ['ids'], 'members' => ['ids' => ['shape' => 'BuildIds']]], 'BatchDeleteBuildsOutput' => ['type' => 'structure', 'members' => ['buildsDeleted' => ['shape' => 'BuildIds'], 'buildsNotDeleted' => ['shape' => 'BuildsNotDeleted']]], 'BatchGetBuildsInput' => ['type' => 'structure', 'required' => ['ids'], 'members' => ['ids' => ['shape' => 'BuildIds']]], 'BatchGetBuildsOutput' => ['type' => 'structure', 'members' => ['builds' => ['shape' => 'Builds'], 'buildsNotFound' => ['shape' => 'BuildIds']]], 'BatchGetProjectsInput' => ['type' => 'structure', 'required' => ['names'], 'members' => ['names' => ['shape' => 'ProjectNames']]], 'BatchGetProjectsOutput' => ['type' => 'structure', 'members' => ['projects' => ['shape' => 'Projects'], 'projectsNotFound' => ['shape' => 'ProjectNames']]], 'Boolean' => ['type' => 'boolean'], 'Build' => ['type' => 'structure', 'members' => ['id' => ['shape' => 'NonEmptyString'], 'arn' => ['shape' => 'NonEmptyString'], 'startTime' => ['shape' => 'Timestamp'], 'endTime' => ['shape' => 'Timestamp'], 'currentPhase' => ['shape' => 'String'], 'buildStatus' => ['shape' => 'StatusType'], 'sourceVersion' => ['shape' => 'NonEmptyString'], 'projectName' => ['shape' => 'NonEmptyString'], 'phases' => ['shape' => 'BuildPhases'], 'source' => ['shape' => 'ProjectSource'], 'artifacts' => ['shape' => 'BuildArtifacts'], 'cache' => ['shape' => 'ProjectCache'], 'environment' => ['shape' => 'ProjectEnvironment'], 'logs' => ['shape' => 'LogsLocation'], 'timeoutInMinutes' => ['shape' => 'WrapperInt'], 'buildComplete' => ['shape' => 'Boolean'], 'initiator' => ['shape' => 'String'], 'vpcConfig' => ['shape' => 'VpcConfig'], 'networkInterface' => ['shape' => 'NetworkInterface']]], 'BuildArtifacts' => ['type' => 'structure', 'members' => ['location' => ['shape' => 'String'], 'sha256sum' => ['shape' => 'String'], 'md5sum' => ['shape' => 'String']]], 'BuildIds' => ['type' => 'list', 'member' => ['shape' => 'NonEmptyString'], 'max' => 100, 'min' => 1], 'BuildNotDeleted' => ['type' => 'structure', 'members' => ['id' => ['shape' => 'NonEmptyString'], 'statusCode' => ['shape' => 'String']]], 'BuildPhase' => ['type' => 'structure', 'members' => ['phaseType' => ['shape' => 'BuildPhaseType'], 'phaseStatus' => ['shape' => 'StatusType'], 'startTime' => ['shape' => 'Timestamp'], 'endTime' => ['shape' => 'Timestamp'], 'durationInSeconds' => ['shape' => 'WrapperLong'], 'contexts' => ['shape' => 'PhaseContexts']]], 'BuildPhaseType' => ['type' => 'string', 'enum' => ['SUBMITTED', 'PROVISIONING', 'DOWNLOAD_SOURCE', 'INSTALL', 'PRE_BUILD', 'BUILD', 'POST_BUILD', 'UPLOAD_ARTIFACTS', 'FINALIZING', 'COMPLETED']], 'BuildPhases' => ['type' => 'list', 'member' => ['shape' => 'BuildPhase']], 'Builds' => ['type' => 'list', 'member' => ['shape' => 'Build']], 'BuildsNotDeleted' => ['type' => 'list', 'member' => ['shape' => 'BuildNotDeleted']], 'CacheType' => ['type' => 'string', 'enum' => ['NO_CACHE', 'S3']], 'ComputeType' => ['type' => 'string', 'enum' => ['BUILD_GENERAL1_SMALL', 'BUILD_GENERAL1_MEDIUM', 'BUILD_GENERAL1_LARGE']], 'CreateProjectInput' => ['type' => 'structure', 'required' => ['name', 'source', 'artifacts', 'environment'], 'members' => ['name' => ['shape' => 'ProjectName'], 'description' => ['shape' => 'ProjectDescription'], 'source' => ['shape' => 'ProjectSource'], 'artifacts' => ['shape' => 'ProjectArtifacts'], 'cache' => ['shape' => 'ProjectCache'], 'environment' => ['shape' => 'ProjectEnvironment'], 'serviceRole' => ['shape' => 'NonEmptyString'], 'timeoutInMinutes' => ['shape' => 'TimeOut'], 'encryptionKey' => ['shape' => 'NonEmptyString'], 'tags' => ['shape' => 'TagList'], 'vpcConfig' => ['shape' => 'VpcConfig'], 'badgeEnabled' => ['shape' => 'WrapperBoolean']]], 'CreateProjectOutput' => ['type' => 'structure', 'members' => ['project' => ['shape' => 'Project']]], 'CreateWebhookInput' => ['type' => 'structure', 'required' => ['projectName'], 'members' => ['projectName' => ['shape' => 'ProjectName'], 'branchFilter' => ['shape' => 'String']]], 'CreateWebhookOutput' => ['type' => 'structure', 'members' => ['webhook' => ['shape' => 'Webhook']]], 'DeleteProjectInput' => ['type' => 'structure', 'required' => ['name'], 'members' => ['name' => ['shape' => 'NonEmptyString']]], 'DeleteProjectOutput' => ['type' => 'structure', 'members' => []], 'DeleteWebhookInput' => ['type' => 'structure', 'required' => ['projectName'], 'members' => ['projectName' => ['shape' => 'ProjectName']]], 'DeleteWebhookOutput' => ['type' => 'structure', 'members' => []], 'EnvironmentImage' => ['type' => 'structure', 'members' => ['name' => ['shape' => 'String'], 'description' => ['shape' => 'String'], 'versions' => ['shape' => 'ImageVersions']]], 'EnvironmentImages' => ['type' => 'list', 'member' => ['shape' => 'EnvironmentImage']], 'EnvironmentLanguage' => ['type' => 'structure', 'members' => ['language' => ['shape' => 'LanguageType'], 'images' => ['shape' => 'EnvironmentImages']]], 'EnvironmentLanguages' => ['type' => 'list', 'member' => ['shape' => 'EnvironmentLanguage']], 'EnvironmentPlatform' => ['type' => 'structure', 'members' => ['platform' => ['shape' => 'PlatformType'], 'languages' => ['shape' => 'EnvironmentLanguages']]], 'EnvironmentPlatforms' => ['type' => 'list', 'member' => ['shape' => 'EnvironmentPlatform']], 'EnvironmentType' => ['type' => 'string', 'enum' => ['LINUX_CONTAINER']], 'EnvironmentVariable' => ['type' => 'structure', 'required' => ['name', 'value'], 'members' => ['name' => ['shape' => 'NonEmptyString'], 'value' => ['shape' => 'String'], 'type' => ['shape' => 'EnvironmentVariableType']]], 'EnvironmentVariableType' => ['type' => 'string', 'enum' => ['PLAINTEXT', 'PARAMETER_STORE']], 'EnvironmentVariables' => ['type' => 'list', 'member' => ['shape' => 'EnvironmentVariable']], 'GitCloneDepth' => ['type' => 'integer', 'min' => 0], 'ImageVersions' => ['type' => 'list', 'member' => ['shape' => 'String']], 'InvalidInputException' => ['type' => 'structure', 'members' => [], 'exception' => \true], 'InvalidateProjectCacheInput' => ['type' => 'structure', 'required' => ['projectName'], 'members' => ['projectName' => ['shape' => 'NonEmptyString']]], 'InvalidateProjectCacheOutput' => ['type' => 'structure', 'members' => []], 'KeyInput' => ['type' => 'string', 'max' => 127, 'min' => 1, 'pattern' => '^([\\\\p{L}\\\\p{Z}\\\\p{N}_.:/=@+\\\\-]*)$'], 'LanguageType' => ['type' => 'string', 'enum' => ['JAVA', 'PYTHON', 'NODE_JS', 'RUBY', 'GOLANG', 'DOCKER', 'ANDROID', 'DOTNET', 'BASE']], 'ListBuildsForProjectInput' => ['type' => 'structure', 'required' => ['projectName'], 'members' => ['projectName' => ['shape' => 'NonEmptyString'], 'sortOrder' => ['shape' => 'SortOrderType'], 'nextToken' => ['shape' => 'String']]], 'ListBuildsForProjectOutput' => ['type' => 'structure', 'members' => ['ids' => ['shape' => 'BuildIds'], 'nextToken' => ['shape' => 'String']]], 'ListBuildsInput' => ['type' => 'structure', 'members' => ['sortOrder' => ['shape' => 'SortOrderType'], 'nextToken' => ['shape' => 'String']]], 'ListBuildsOutput' => ['type' => 'structure', 'members' => ['ids' => ['shape' => 'BuildIds'], 'nextToken' => ['shape' => 'String']]], 'ListCuratedEnvironmentImagesInput' => ['type' => 'structure', 'members' => []], 'ListCuratedEnvironmentImagesOutput' => ['type' => 'structure', 'members' => ['platforms' => ['shape' => 'EnvironmentPlatforms']]], 'ListProjectsInput' => ['type' => 'structure', 'members' => ['sortBy' => ['shape' => 'ProjectSortByType'], 'sortOrder' => ['shape' => 'SortOrderType'], 'nextToken' => ['shape' => 'NonEmptyString']]], 'ListProjectsOutput' => ['type' => 'structure', 'members' => ['nextToken' => ['shape' => 'String'], 'projects' => ['shape' => 'ProjectNames']]], 'LogsLocation' => ['type' => 'structure', 'members' => ['groupName' => ['shape' => 'String'], 'streamName' => ['shape' => 'String'], 'deepLink' => ['shape' => 'String']]], 'NetworkInterface' => ['type' => 'structure', 'members' => ['subnetId' => ['shape' => 'NonEmptyString'], 'networkInterfaceId' => ['shape' => 'NonEmptyString']]], 'NonEmptyString' => ['type' => 'string', 'min' => 1], 'OAuthProviderException' => ['type' => 'structure', 'members' => [], 'exception' => \true], 'PhaseContext' => ['type' => 'structure', 'members' => ['statusCode' => ['shape' => 'String'], 'message' => ['shape' => 'String']]], 'PhaseContexts' => ['type' => 'list', 'member' => ['shape' => 'PhaseContext']], 'PlatformType' => ['type' => 'string', 'enum' => ['DEBIAN', 'AMAZON_LINUX', 'UBUNTU']], 'Project' => ['type' => 'structure', 'members' => ['name' => ['shape' => 'ProjectName'], 'arn' => ['shape' => 'String'], 'description' => ['shape' => 'ProjectDescription'], 'source' => ['shape' => 'ProjectSource'], 'artifacts' => ['shape' => 'ProjectArtifacts'], 'cache' => ['shape' => 'ProjectCache'], 'environment' => ['shape' => 'ProjectEnvironment'], 'serviceRole' => ['shape' => 'NonEmptyString'], 'timeoutInMinutes' => ['shape' => 'TimeOut'], 'encryptionKey' => ['shape' => 'NonEmptyString'], 'tags' => ['shape' => 'TagList'], 'created' => ['shape' => 'Timestamp'], 'lastModified' => ['shape' => 'Timestamp'], 'webhook' => ['shape' => 'Webhook'], 'vpcConfig' => ['shape' => 'VpcConfig'], 'badge' => ['shape' => 'ProjectBadge']]], 'ProjectArtifacts' => ['type' => 'structure', 'required' => ['type'], 'members' => ['type' => ['shape' => 'ArtifactsType'], 'location' => ['shape' => 'String'], 'path' => ['shape' => 'String'], 'namespaceType' => ['shape' => 'ArtifactNamespace'], 'name' => ['shape' => 'String'], 'packaging' => ['shape' => 'ArtifactPackaging']]], 'ProjectBadge' => ['type' => 'structure', 'members' => ['badgeEnabled' => ['shape' => 'Boolean'], 'badgeRequestUrl' => ['shape' => 'String']]], 'ProjectCache' => ['type' => 'structure', 'required' => ['type'], 'members' => ['type' => ['shape' => 'CacheType'], 'location' => ['shape' => 'String']]], 'ProjectDescription' => ['type' => 'string', 'max' => 255, 'min' => 0], 'ProjectEnvironment' => ['type' => 'structure', 'required' => ['type', 'image', 'computeType'], 'members' => ['type' => ['shape' => 'EnvironmentType'], 'image' => ['shape' => 'NonEmptyString'], 'computeType' => ['shape' => 'ComputeType'], 'environmentVariables' => ['shape' => 'EnvironmentVariables'], 'privilegedMode' => ['shape' => 'WrapperBoolean'], 'certificate' => ['shape' => 'String']]], 'ProjectName' => ['type' => 'string', 'max' => 255, 'min' => 2, 'pattern' => '[A-Za-z0-9][A-Za-z0-9\\-_]{1,254}'], 'ProjectNames' => ['type' => 'list', 'member' => ['shape' => 'NonEmptyString'], 'max' => 100, 'min' => 1], 'ProjectSortByType' => ['type' => 'string', 'enum' => ['NAME', 'CREATED_TIME', 'LAST_MODIFIED_TIME']], 'ProjectSource' => ['type' => 'structure', 'required' => ['type'], 'members' => ['type' => ['shape' => 'SourceType'], 'location' => ['shape' => 'String'], 'gitCloneDepth' => ['shape' => 'GitCloneDepth'], 'buildspec' => ['shape' => 'String'], 'auth' => ['shape' => 'SourceAuth'], 'insecureSsl' => ['shape' => 'WrapperBoolean']]], 'Projects' => ['type' => 'list', 'member' => ['shape' => 'Project']], 'ResourceAlreadyExistsException' => ['type' => 'structure', 'members' => [], 'exception' => \true], 'ResourceNotFoundException' => ['type' => 'structure', 'members' => [], 'exception' => \true], 'SecurityGroupIds' => ['type' => 'list', 'member' => ['shape' => 'NonEmptyString'], 'max' => 5], 'SortOrderType' => ['type' => 'string', 'enum' => ['ASCENDING', 'DESCENDING']], 'SourceAuth' => ['type' => 'structure', 'required' => ['type'], 'members' => ['type' => ['shape' => 'SourceAuthType'], 'resource' => ['shape' => 'String']]], 'SourceAuthType' => ['type' => 'string', 'enum' => ['OAUTH']], 'SourceType' => ['type' => 'string', 'enum' => ['CODECOMMIT', 'CODEPIPELINE', 'GITHUB', 'S3', 'BITBUCKET', 'GITHUB_ENTERPRISE']], 'StartBuildInput' => ['type' => 'structure', 'required' => ['projectName'], 'members' => ['projectName' => ['shape' => 'NonEmptyString'], 'sourceVersion' => ['shape' => 'String'], 'artifactsOverride' => ['shape' => 'ProjectArtifacts'], 'environmentVariablesOverride' => ['shape' => 'EnvironmentVariables'], 'gitCloneDepthOverride' => ['shape' => 'GitCloneDepth'], 'buildspecOverride' => ['shape' => 'String'], 'timeoutInMinutesOverride' => ['shape' => 'TimeOut']]], 'StartBuildOutput' => ['type' => 'structure', 'members' => ['build' => ['shape' => 'Build']]], 'StatusType' => ['type' => 'string', 'enum' => ['SUCCEEDED', 'FAILED', 'FAULT', 'TIMED_OUT', 'IN_PROGRESS', 'STOPPED']], 'StopBuildInput' => ['type' => 'structure', 'required' => ['id'], 'members' => ['id' => ['shape' => 'NonEmptyString']]], 'StopBuildOutput' => ['type' => 'structure', 'members' => ['build' => ['shape' => 'Build']]], 'String' => ['type' => 'string'], 'Subnets' => ['type' => 'list', 'member' => ['shape' => 'NonEmptyString'], 'max' => 16], 'Tag' => ['type' => 'structure', 'members' => ['key' => ['shape' => 'KeyInput'], 'value' => ['shape' => 'ValueInput']]], 'TagList' => ['type' => 'list', 'member' => ['shape' => 'Tag'], 'max' => 50, 'min' => 0], 'TimeOut' => ['type' => 'integer', 'max' => 480, 'min' => 5], 'Timestamp' => ['type' => 'timestamp'], 'UpdateProjectInput' => ['type' => 'structure', 'required' => ['name'], 'members' => ['name' => ['shape' => 'NonEmptyString'], 'description' => ['shape' => 'ProjectDescription'], 'source' => ['shape' => 'ProjectSource'], 'artifacts' => ['shape' => 'ProjectArtifacts'], 'cache' => ['shape' => 'ProjectCache'], 'environment' => ['shape' => 'ProjectEnvironment'], 'serviceRole' => ['shape' => 'NonEmptyString'], 'timeoutInMinutes' => ['shape' => 'TimeOut'], 'encryptionKey' => ['shape' => 'NonEmptyString'], 'tags' => ['shape' => 'TagList'], 'vpcConfig' => ['shape' => 'VpcConfig'], 'badgeEnabled' => ['shape' => 'WrapperBoolean']]], 'UpdateProjectOutput' => ['type' => 'structure', 'members' => ['project' => ['shape' => 'Project']]], 'UpdateWebhookInput' => ['type' => 'structure', 'required' => ['projectName'], 'members' => ['projectName' => ['shape' => 'ProjectName'], 'branchFilter' => ['shape' => 'String'], 'rotateSecret' => ['shape' => 'Boolean']]], 'UpdateWebhookOutput' => ['type' => 'structure', 'members' => ['webhook' => ['shape' => 'Webhook']]], 'ValueInput' => ['type' => 'string', 'max' => 255, 'min' => 1, 'pattern' => '^([\\\\p{L}\\\\p{Z}\\\\p{N}_.:/=@+\\\\-]*)$'], 'VpcConfig' => ['type' => 'structure', 'members' => ['vpcId' => ['shape' => 'NonEmptyString'], 'subnets' => ['shape' => 'Subnets'], 'securityGroupIds' => ['shape' => 'SecurityGroupIds']]], 'Webhook' => ['type' => 'structure', 'members' => ['url' => ['shape' => 'NonEmptyString'], 'payloadUrl' => ['shape' => 'NonEmptyString'], 'secret' => ['shape' => 'NonEmptyString'], 'branchFilter' => ['shape' => 'String'], 'lastModifiedSecret' => ['shape' => 'Timestamp']]], 'WrapperBoolean' => ['type' => 'boolean'], 'WrapperInt' => ['type' => 'integer'], 'WrapperLong' => ['type' => 'long']]];
